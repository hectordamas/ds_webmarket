<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Order};

class OrderController extends Controller
{
    public function getCompletedOrders(){

        $orders = Order::where('status', 'Entregado')->with(['products.options', 'products.product' => function ($query) {
            $query->select('id', 'name', 'sku');
        }])
        ->get()
        ->map(function ($order) {
            return [
                'id' => $order->id,
                'estado' => $order->status,
                'total' => $order->total,
                'productos' => $order->products->map(function ($op) {
                    return [
                        'nombre' => $op->product->name ?? null,
                        'sku' => $op->product->sku ?? null,
                        'cantidad' => $op->quantity,
                        'precio_unitario' => $op->unit_price,
                        'subtotal' => $op->subtotal,
                        'id' => $op->product->id ?? null,
                        'extras' => $op->options->map(function ($extra) {
                            return [
                                'grupo' => $extra->group_name,
                                'opcion' => $extra->name,
                                'precio' => $extra->price
                            ];
                        })
                    ];
                })
            ];
        });

        return response()->json($orders);
    }
}
