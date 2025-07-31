<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product};

class ProductController extends Controller
{
    public function store(Request $request)
    {
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
                //$product->description = $request->description ?? ''; // si es general
                //$product->category_id = $request->codcategory ?? ''; // si es general
                $product->stock = $item['Existen'] ?? 0;
                $product->active = $item['Activo'];
                $product->price = $item['Pvpdolar1'] ?? 0;

                $product->save();
            }
        }

        return response()->json([
            'success' => true
        ]);
    }

}
