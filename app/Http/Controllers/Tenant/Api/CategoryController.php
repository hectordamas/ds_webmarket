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
		try {
			$regla = Validator::make($request->all(), [
			    '*.Descrip' => 'required|string|max:255',
			    '*.Activo' => 'required|boolean',
			    '*.CodInst' => 'required|string|max:50',
			], [
			    'required' => 'No se enviaron datos para procesar.',
			    'array' => 'Los datos deben ser un arreglo.',
			    'min' => 'Se requiere al menos un elemento en el arreglo de datos.',
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

			$data = Array();
        	$datosReq = $request->all(); 
		
			for ($i = 0; $i < count($datosReq); $i++) {
				$data['Descrip'][$i] = @$datosReq[$i]['Descrip'];
				$data['Activo'][$i] = @$datosReq[$i]['Activo'];
				$data['CodInst'][$i]     = @$datosReq[$i]['CodInst'];
			}

        	for ($i = 0; $i < count($data['CodInst']); $i++) {
        	    // Puedes buscar por nombre si aún no tienes CodCat o un ID único
        	    $category = Category::where('codinst', $item[$i]['CodInst'])->first();
			
        	    if (!$category) {
        	        $category = new Category();
        	    }
			
        	    $category->name = $item[$i]['Descrip'];
        	    $category->active = $item[$i]['Activo'];
				$category->codinst = $item[$i]['CodInst'];
				$category->slug = Str::slug($item[$i]['Descrip']);
        	    $category->save();
        	}
		
        	return response()->json([
        	    'success' => true
        	]);
		} catch (\Exception $e) {
			return response()->json([$e->getMessage(), 'Linea ' . $e->getLine()]);
		}

    }

}
