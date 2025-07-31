<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product};
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
		$regla = Validator::make(['data' => $request->all()], [
		    'data' => 'required|array|min:1',
		    'data.*.Descrip' => 'required|string|max:255',
		    'data.*.Activo' => 'required|boolean',
		    'data.*.CodInst' => 'required|string|max:50',
		], [
		    'data.required' => 'No se enviaron datos para procesar.',
		    'data.array' => 'Los datos deben ser un arreglo.',
		    'data.min' => 'Se requiere al menos un elemento en el arreglo de datos.',
		    'required' => 'El campo :attribute es obligatorio.',
		    'string' => 'El campo :attribute debe ser una cadena de texto.',
		    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
		    'max' => 'El campo :attribute no debe tener más de :max caracteres.',
		]);
		
		if ($regla->fails()) {
		    return response()->json([
		        'success' => false,
		        'errors' => $regla->errors()
		    ], 422);
		}

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
