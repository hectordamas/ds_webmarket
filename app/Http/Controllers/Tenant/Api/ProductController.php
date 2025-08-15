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
                $sku = $data['CodProd'][$i]  ?? null;
                $evento = $data['Evento'][$i] ?? null;

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
                
                    $product->sku = $data['CodProd'][$i];
                    $product->name = $data['Descrip'][$i];
                    $product->description = $data['Descripcion'][$i];
                    $product->codinst = $data['CodInst'][$i];
                    $product->stock = $data['Existen'][$i];
                    $product->active = $data['Activo'][$i];
                    $product->price = $data['Precio'][$i];
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
