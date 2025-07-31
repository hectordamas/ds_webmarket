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
	    $regla = Validator::make($request->all(), [
	        'CodInst' => 'required|string|max:50',
	        'Descrip' => 'required|string|max:255',
	        'Activo'  => 'required|boolean',
	    ]);
	
	    if ($regla->fails()) {
	        return response()->json([
	            'success' => false,
	            'errors' => $regla->errors()
	        ], 422);
	    }
	
	    $category = Category::where('codinst', $request->CodInst)->first();
	
	    if (!$category) {
	        $category = new Category();
	    }
	
	    $category->name = $request->Descrip;
	    $category->active = $request->Activo;
	    $category->codinst = $request->CodInst;
	    $category->save();
	
	    return response()->json(['success' => true]);
	}
}
