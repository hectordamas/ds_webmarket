<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
		try {
			$data = [];
        	$datosReq = $request->all(); 
		
			for ($i = 0; $i < count($datosReq); $i++) {
				$data['Descrip'][$i] = @$datosReq[$i]['Descrip'];
				$data['Activo'][$i] = @$datosReq[$i]['Activo'];
				$data['CodInst'][$i] = @$datosReq[$i]['CodInst'];
			}

        	for ($i = 0; $i < count($data['CodInst']); $i++) {
        	    // Puedes buscar por nombre si aún no tienes CodCat o un ID único
        	    $category = Category::where('codinst', $data['CodInst'][$i])->first();
			
        	    if (!$category) {
        	        $category = new Category();
        	    }
			
        	    $category->name = $data['Descrip'][$i];
        	    $category->active = $data['Activo'][$i];
				$category->codinst = $data['CodInst'][$i];
				$category->slug = Str::slug($data['Descrip'][$i]);
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
