<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Order, OrderProduct, OrderProductOption, Payment, Customer};
use Carbon\Carbon;
use Cart;

class OrderController extends Controller
{
    private function getOrdersByRange($range)
    {
        $today = Carbon::today();

        switch ($range) {
            case 'week':
                $from = $today->copy()->startOfWeek()->startOfDay();
                $to = $today->copy()->endOfWeek()->endOfDay();
                break;
            case 'month':
                $from = $today->copy()->startOfMonth()->startOfDay();
                $to = $today->copy()->endOfMonth()->endOfDay();
                break;
            case 'year':
                $from = $today->copy()->startOfYear()->startOfDay();
                $to = $today->copy()->endOfYear()->endOfDay();
                break;
            default:
                $from = $today->copy()->startOfDay();
                $to = $today->copy()->endOfDay();
                break;
        }

        return Order::whereBetween('created_at', [$from, $to])->orderBy('id', 'desc');
    }


    public function index()
    {
        return view('tenant.admin.orders.index');
    }

    public function getOrdersData(Request $request)
    {
        $range = $request->input('range', 'today');

        $ordersQuery = $this->getOrdersByRange($range);

        $orders = $ordersQuery->get();

        $totalRecords = $orders->count();

        // Contadores por estatus usando el mismo query base para optimizar:
        $pendientes = (clone $ordersQuery)->where('status', 'Pendiente')->count();
        $confirmados = (clone $ordersQuery)->where('status', 'Confirmado')->count();
        $enviados = (clone $ordersQuery)->where('status', 'Enviado')->count();
        $entregados = (clone $ordersQuery)->where('status', 'Entregado')->count();
        $cancelados = (clone $ordersQuery)->where('status', 'Cancelado')->count();
        $totalVentas = (clone $ordersQuery)->where('status', 'Entregado')->sum('total');

        $data = $orders->map(fn($order) => $this->getOrderRow($order))->toArray();

        return response()->json([
            "sEcho" => 1,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            'aaData' => $data,
            'pendientes' => $pendientes,
            'confirmados' => $confirmados,
            'enviados' => $enviados,
            'entregados' => $entregados,
            'cancelados' => $cancelados,
            'totalVentas' => '$'. number_format($totalVentas, 2, '.', ','),
        ]);
    }

    public function getOrderRow($order)
    {
        $statusColors = [
          'Pendiente'   => 'warning',
          'Confirmado'  => 'info',
          'Enviado'     => 'primary',
          'Entregado'   => 'success',
          'Cancelado'   => 'danger',
        ];

        return [
            'id' => $order->id,
            'nombre' => (!$order->is_read ? '<span class="d-inline-block rounded-circle pulse point'.$order->id.' me-2" style="width: 10px; height: 10px; margin-top: 6px; background-color: red;"></span>' : '').$order->nombre,
            'cedula' => $order->tipo_documento . $order->cedula,
            'metodo_pago' => $order->metodo_pago,
            'total' => '<span class="text-success fw-bold">$' . number_format($order->total, 2, '.', ',') . '</span>',
            'estatus' => '<span class="badge bg-' . ($statusColors[$order->status] ?? 'dark') . '">' . $order->status . '</span>',
            'fecha' => \Carbon\Carbon::parse($order->created_at)->format('d/m/Y h:i a'),
            'acciones' => '<a href="javascript:void(0)" data-id="'.$order->id.'" class="btn btn-dark btn-sm viewDetailsButton"><i class="fas fa-list"></i> Ver Detalles</a>
                           <a href="javascript:void(0)" class="btn btn-success btn-sm updateStatusBtn" data-id="'.$order->id.'" data-current-status="'.$order->status.'" data-bs-toggle="modal" data-bs-target="#updateStatusModal"><i class="far fa-edit"></i> Actualizar Estatus</a>',
            'is_read' => $order->is_read, // opcional, para `createdRow`
        ];    
    }

    public function polling(Request $request)
    {
        $lastId = $request->input('last_id', 0);
        $range = $request->input('range', 'today');
    
        // Consulta base filtrada por rango
        $ordersQuery = $this->getOrdersByRange($range);
    
        // Nuevas órdenes después de lastId
        $newOrdersQuery = (clone $ordersQuery)->where('id', '>', $lastId);
        $newOrders = $newOrdersQuery->get();
    
        // Calcular contadores en el rango (sin filtrar por lastId)
        $pendientes = (clone $ordersQuery)->where('status', 'Pendiente')->count();
        $confirmados = (clone $ordersQuery)->where('status', 'Confirmado')->count();
        $enviados = (clone $ordersQuery)->where('status', 'Enviado')->count();
        $entregados = (clone $ordersQuery)->where('status', 'Entregado')->count();
        $cancelados = (clone $ordersQuery)->where('status', 'Cancelado')->count();
        $totalVentas = (clone $ordersQuery)->where('status', 'Entregado')->sum('total');
    
        $orders = $newOrders->map(function ($order) {
            return [
                'id' => $order->id,
                'html' => $this->getOrderRow($order),
                'is_read' => $order->is_read,
            ];
        });
    
        return response()->json([
            'orders' => $orders,
            'pendientes' => $pendientes,
            'confirmados' => $confirmados,
            'enviados' => $enviados,
            'entregados' => $entregados,
            'cancelados' => $cancelados,
            'totalVentas' => '$ ' . number_format($totalVentas, 2, '.', ','),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'cedula' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'nullable|string',
            'detalle_direccion' => 'nullable|string',
            'metodo_pago' => 'required|string',
            'tipo_pedido' => 'required|string',
            'tipo_documento' => 'required|string',
        ]);

        // Crear la orden (adaptar según modelo)
        $payment = Payment::find($data['metodo_pago']);

        $customer = new Customer();
        $customer->nombre = $data['nombre'];
        $customer->tipo_documento = $data['tipo_documento'];
        $customer->cedula = $data['cedula'];
        $customer->telefono = $data['telefono'];
        $customer->direccion = $data['direccion'] ?? null;
        $customer->detalle_direccion = $data['detalle_direccion'] ?? null;
        $customer->save();

        $order = new Order();
        $order->nombre = $data['nombre'];
        $order->tipo_documento = $data['tipo_documento'];
        $order->cedula = $data['cedula'];
        $order->telefono = $data['telefono'];
        $order->direccion = $data['direccion'] ?? null;
        $order->detalle_direccion = $data['detalle_direccion'] ?? null;
        $order->payment_id = $data['metodo_pago'];
        $order->metodo_pago = $payment->name;
        $order->tipo_pedido = $data['tipo_pedido'];
        $order->total = Cart::subtotal();
        $order->items = json_encode(Cart::content()); // O guardar en tabla relacionada
        $order->customer_id = $customer->id;
        $order->save();

        foreach (Cart::content() as $item) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $item->id;
            $orderProduct->quantity = $item->qty;
            $orderProduct->unit_price = $item->price;
            $orderProduct->subtotal = $item->price * $item->qty;
            $orderProduct->observations = $item->options->observations ?? null;
            $orderProduct->save();

            // 3. Guardar las opciones (si hay)
            foreach ($item->options->extras as $grupo => $opciones) {
                foreach ($opciones as $opcion) {
                    // Intentar separar el nombre y el precio si tiene formato: "Mostaza (+$0.50)"
                    $nombre = $opcion;
                    $precio = 0;
                    if (preg_match('/(.+)\s+\(\+\$(\d+(?:\.\d+)?)\)/', $opcion, $match)) {
                        $nombre = trim($match[1]);
                        $precio = (float) $match[2];
                    }
                    $op = new OrderProductOption();
                    $op->order_product_id = $orderProduct->id;
                    $op->option_group_name = $grupo;
                    $op->option_name = $nombre;
                    $op->price = $precio;
                    $op->save();
                }
            }
        }

        $html = view('tenant.shop.components.cart.completed', [
            'order' => $order
        ])->render();

        return response()->json([
            'success' => true, 
            'order_id' => $order->id,
            'html' => $html
        ]);
    }

    public function show($id){
        $order = Order::find($id);
        $order->is_read = true;
        $order->save();

        return view('tenant.admin.orders.show', [
            'order' => $order
        ]);
    }

    public function detalle(Request $request)
    {
        $orderId = $request->input('id');
        $order = Order::findOrFail($orderId);
        $order->is_read = true;
        $order->save();
        
        // Retornamos un view parcial con los datos
        return view('tenant.admin.orders.partials.detalle', compact('order'))->render();
    }

    public function track($id){
        $order = Order::find($id);

        return view('tenant.shop.orders.track', [
            'order' => $order
        ]);
    }

    public function trackContent($id){
        $order = Order::find($id);

        $html = view('tenant.shop.orders.track-content', [
            'order' => $order
        ])->render();

        return response()->json([
            'html' => $html
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:orders,id',
            'status' => 'required|string'
        ]);
    
        $order = Order::findOrFail($request->id);
        $order->status = $request->status;
        $order->save();
    
        return response()->json(['success' => true]);
    }


}
