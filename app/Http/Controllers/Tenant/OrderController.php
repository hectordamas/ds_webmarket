<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Order, OrderProduct, OrderProductOption};
use Cart;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'cedula' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'nullable|string',
            'metodo_pago' => 'required|string',
            'tipo_pedido' => 'required|string',
        ]);

        // Crear la orden (adaptar según modelo)
        $order = new Order();
        $order->nombre = $data['nombre'];
        $order->cedula = $data['cedula'];
        $order->telefono = $data['telefono'];
        $order->direccion = $data['direccion'] ?? null;
        $order->metodo_pago = $data['metodo_pago'];
        $order->tipo_pedido = $data['tipo_pedido'];
        $order->total = Cart::subtotal();
        $order->items = json_encode(Cart::content()); // O guardar en tabla relacionada
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
            if (!empty($item->options->extras)) {
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
        }

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }
}
