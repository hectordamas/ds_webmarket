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
            $nombre = $item['Descrip'] ?? null;
            $activo = $item['Activo'];

            if (!$nombre) {
                continue; // ignorar si no hay nombre
            }

            // Puedes buscar por nombre si aún no tienes CodCat o un ID único
            $category = Category::where('name', $nombre)->first();

            if (!$category) {
                $category = new Category();
            }

            $category->name = $nombre;
            $category->active = $activo;

            $category->save();
        }

        return response()->json([
            'success' => true
        ]);
    }

}
