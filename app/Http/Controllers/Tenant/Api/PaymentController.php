<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Payment};

class PaymentController extends Controller
{
    public function store(Request $request){
		try {
			$data = [];
        	$datosReq = $request->all(); 
		
			for ($i = 0; $i < count($datosReq); $i++) {
				$data['Descrip'][$i] = @$datosReq[$i]['Descrip'];
				$data['Activo'][$i] = @$datosReq[$i]['Activo'];
			}

            for ($i = 0; $i < count($data['CodProd']); $i++) {
                $sku = $data['CodProd'][$i]  ?? null;
                $evento = $data['Evento'][$i] ?? null;

                if (!$sku || !$evento) {
                    continue;
                }
            
                $product = Payment::where('sku', $sku)->first();
            
                if ($evento == 'D') {
                    if ($product) {
                        $product->delete();
                    }
                } else {
                    if (!$product) {
                        $product = new Product();
                        $product->sku = $sku;
                    }
                
                    $product->sku = $data['CodProd'][$i];
                    $product->name = $data['Descrip'][$i];
                    $product->description = $data['Descripcion'][$i];
                    $product->codinst = $data['CodInst'][$i];
                    $product->stock = $data['Existen'][$i];
                    $product->active = $data['Activo'][$i];
                    $product->save();
                }
            }
            return response()->json([
                'success' => true
            ]);
        }catch(\Exception $e){
			return response()->json([$e->getMessage(), 'Linea ' . $e->getLine()]);
        };
    }
}
