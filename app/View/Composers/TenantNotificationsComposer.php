<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Tenant\Order;

class TenantNotificationsComposer
{
    public function compose(View $view)
    {
        $notificaciones = Order::latest()->take(5)->get(); // Puedes filtrar por status si quieres
        $noLeidas = Order::where('is_read', false)->count();
        $lastOrderId = Order::orderBy('id', 'desc')->first()->id;

        $view->with([
            'notificacionesTenant' => $notificaciones,
            'notificacionesNoLeidas' => $noLeidas,
            'lastOrderId' => $lastOrderId
        ]);    
    }
}