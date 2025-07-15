<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Order};

class NotificationController extends Controller
{
    public function polling()
    {
        $notificacionesTenant = Order::latest()->take(5)->get();
        $noLeidas = Order::where('is_read', false)->count();

        $html = view('tenant.admin.orders.partials.notifications', compact('notificacionesTenant', 'noLeidas'))->render();

        return response()->json([
            'html' => $html,
            'contador' => $noLeidas,
        ]);
    }
}
