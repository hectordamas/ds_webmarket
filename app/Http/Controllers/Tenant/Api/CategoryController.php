<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product};

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $datosReq = $request->all(); 

        foreach ($datosReq as $item) {
            // Puedes buscar por nombre si aún no tienes CodCat o un ID único
            $category = Category::where('condinst', $item['CodInst'])->first();

            if (!$category) {
                $category = new Category();
            }

            $category->name = $item['Descrip'] ;
            $category->active = $item['Activo'];
			$category->codinst = $item['CodInst'];
            $category->save();
        }

        return response()->json([
            'success' => true
        ]);
    }

}
