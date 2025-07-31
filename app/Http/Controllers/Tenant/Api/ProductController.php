<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product};
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $regla = Validator::make($request->all(), [
            'CodProd'     => 'required|string|max:100',
            'Evento'      => 'required|in:A,U,D',
            'Descrip'     => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'CodInst'     => 'required|string|max:50',
            'Existen'     => 'nullable|numeric',
            'Activo'      => 'required|boolean',
            'Precio'      => 'nullable|numeric',
        ], [
            'required'  => 'El campo :attribute es obligatorio.',
            'string'    => 'El campo :attribute debe ser una cadena de texto.',
            'numeric'   => 'El campo :attribute debe ser un número.',
            'boolean'   => 'El campo :attribute debe ser verdadero o falso.',
            'in'        => 'El campo :attribute debe ser uno de los siguientes valores: :values.',
            'max'       => 'El campo :attribute no debe tener más de :max caracteres.',
        ]);

		if ($regla->fails())
        {
			foreach($regla->errors()->messages() as $error){
				$mensaje=$error;
			}            
			return redirect()->back()->withErrors($mensaje[0]."-4");
        }

        $datosReq = $request->all(); 

        foreach ($datosReq as $item) {
            $sku = $item['CodProd'] ?? null;
            $evento = $item['Evento'] ?? null;

            if (!$sku || !$evento) {
                continue; // ignorar si faltan datos importantes
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

                $product->name = $item['Descrip'] ?? '';
                $product->description = $item['Descripcion'] ?? '';
                $product->codinst = $item['CodInst'];
                $product->stock = $item['Existen'] ?? 0;
                $product->active = $item['Activo'];
                $product->price = $item['Precio'] ?? 0;

                $product->save();
            }
        }

        return response()->json([
            'success' => true
        ]);
    }

}
