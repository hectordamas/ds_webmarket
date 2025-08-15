<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product};
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request){
        try {

	        $data = [];
            $datosReq = $request->all(); 

            for ($i = 0; $i < count($datosReq); $i++) {
                $data['CodProd'][$i] = @$datosReq[$i]['CodProd'];
		    	$data['Descrip'][$i] = @$datosReq[$i]['Descrip'];
		    	$data['Activo'][$i] = @$datosReq[$i]['Activo'];
		    	$data['CodInst'][$i] = @$datosReq[$i]['CodInst'];
                $data['Evento'][$i] = @$datosReq[$i]['Evento'];
                $data['Existen'][$i] = @$datosReq[$i]['Existen'];
                $data['Precio'][$i] = @$datosReq[$i]['Precio'];
                $data['Descripcion'][$i] = @$datosReq[$i]['Descripcion'];
		    }

            for ($i = 0; $i < count($data['CodProd']); $i++) {
                $sku = $item['CodProd'][$i]  ?? null;
                $evento = $item['Evento'][$i] ?? null;

                if (!$sku || !$evento) {
                    continue;
                }
            
                $product = Product::where('sku', $sku)->first();
            
                if ($evento == 'D') {
                    if ($product) {
                        $product->delete();
                    }
                } else {
                    if (!$product) {
                        $product = new Product();
                        $product->sku = $sku;
                    }
                
                    $product->sku = $item['CodProd'][$i];
                    $product->name = $item['Descrip'][$i];
                    $product->description = $item['Descripcion'][$i];
                    $product->codinst = $item['CodInst'][$i];
                    $product->stock = $item['Existen'][$i];
                    $product->active = $item['Activo'][$i];
                    $product->price = $item['Precio'][$i];
                    $product->save();
                }
            }

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
			return response()->json([$e->getMessage(), 'Linea ' . $e->getLine()]);
		}

    }

}
