<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product};

class CategoryController extends Controller
{
    public function store(Request $request)
    {
		$regla = Validator::make($request->all(), [
            '*.Descrip' => 'required|string|max:255',
            '*.Activo' => 'required|boolean',
            '*.CodInst' => 'required|string|max:50',
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
