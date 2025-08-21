<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Order};
use Carbon\Carbon;

class NotificationController extends Controller
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

    public function polling(Request $request)
    {
        $lastId = $request->input('last_id', 0);
        $range = $request->input('range', 'today');

        //---------------------------------Fila----------------------------------------------------------//
        // Consulta base filtrada por rango
        $ordersQuery = $this->getOrdersByRange($range);
    
        // Nuevas órdenes después de lastId
        $newOrdersQuery = (clone $ordersQuery)->where('id', '>', $lastId);
        $newOrders = $newOrdersQuery->get();
        $orders = $newOrders->map(function ($order) {
            $html = view('tenant.admin.orders.partials._rows', compact('order'))->render();
            return [
                'id' => $order->id,
                'tipo_pedido' => $order->tipo_pedido,
                'nombre' => $order->nombre,
                'html' => $html,
            ];
        });

        // Calcular contadores en el rango (sin filtrar por lastId)
        $pendientes = (clone $ordersQuery)->where('status', 'Pendiente')->count();
        $confirmados = (clone $ordersQuery)->where('status', 'Confirmado')->count();
        $enviados = (clone $ordersQuery)->where('status', 'Enviado')->count();
        $entregados = (clone $ordersQuery)->where('status', 'Entregado')->count();
        $cancelados = (clone $ordersQuery)->where('status', 'Cancelado')->count();
        $totalVentas = (clone $ordersQuery)->where('status', 'Entregado')->sum('total');        


        //---------------------------------------Bandeja de entrada------------------------------------------------------------------
        $notificacionesTenant = Order::latest()->take(5)->get();
        $noLeidas = Order::where('is_read', false)->count();
        $htmlNotificaciones = view('tenant.admin.orders.partials.notifications', compact('notificacionesTenant', 'noLeidas'))->render();

        return response()->json([
            //Orders
            'orders' => $orders,
            'pendientes' => $pendientes,
            'confirmados' => $confirmados,
            'enviados' => $enviados,
            'entregados' => $entregados,
            'cancelados' => $cancelados,
            'totalVentas' => '$' . number_format($totalVentas, 2, '.', ','),

            //Fila
            'contador' => $noLeidas,
            'html' => $htmlNotificaciones,
            'latest_id' => $newOrders->max('id') ?? $lastId,
        ]);
    }
}
