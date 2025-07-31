<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Order};

class OrderController extends Controller
{
    public function getCompletedOrders(){
        try {
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
                            'id' => $op->product->id ?? null,
                            'nombre' => $op->product->name ?? null,
                            'sku' => $op->product->sku ?? null,
                            'cantidad' => $op->quantity,
                            'precio_unitario' => $op->unit_price,
                            'subtotal' => $op->subtotal,
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
            
        }catch(\Exception $e){
			return response()->json([$e->getMessage(), 'Linea ' . $e->getLine()]);
        }
    }


    public function storeSaintData(Request $request){
        try {
			$data = [];
        	$datosReq = $request->all(); 

            for ($i = 0; $i < count($datosReq); $i++) {
                $data['Id'][$i] = @$datosReq[$i]['Id'];
				$data['Tipofac'][$i] = @$datosReq[$i]['Tipofac'];
				$data['Numerod'][$i] = @$datosReq[$i]['Numerod'];
				$data['Fechae'][$i] = @$datosReq[$i]['Fechae'];
                $data['Ensaint'][$i] = @$datosReq[$i]['Ensaint'];
			}

            for ($i = 0; $i < count($data['Id']); $i++) {
        	    // Puedes buscar por nombre si aún no tienes CodCat o un ID único
        	    $order = Order::find($data['Id'][$i]);
			
        	    $order->tipofac = $data['Tipofac'][$i];
        	    $order->numerod = $data['Numerod'][$i];
				$order->fechae = $data['Fechae'][$i];
				$order->ensaint = $data['Ensaint'][$i];
        	    $order->save();
        	}
		
        	return response()->json([
        	    'success' => true
        	]);

        }catch(\Exception $e){
			return response()->json([$e->getMessage(), 'Linea ' . $e->getLine()]);
        }
    }
}
