<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Order};

class NotificationController extends Controller
{
    public function polling(Request $request)
    {
        $lastId = $request->input('last_id', 0);

        // 🔹 Nuevas órdenes desde el último ID recibido
        $newOrders = Order::where('id', '>', $lastId)->orderBy('id', 'desc')->get();
        $orders = $newOrders->map(function ($order) {
            $html = view('tenant.admin.orders.partials._rows', compact('order'))->render();
            return [
                'id' => $order->id,
                'nombre' => $order->nombre,
                'html' => $html,
            ];
        });

        // 🔹 Notificaciones (las últimas 5)
        $notificacionesTenant = Order::latest()->take(5)->get();
        $noLeidas = Order::where('is_read', false)->count();
        $htmlNotificaciones = view('tenant.admin.orders.partials.notifications', compact('notificacionesTenant', 'noLeidas'))->render();

        return response()->json([
            'orders' => $orders,
            'contador' => $noLeidas,
            
            'html' => $htmlNotificaciones,
            'latest_id' => $newOrders->max('id') ?? $lastId,
        ]);
    }
}
