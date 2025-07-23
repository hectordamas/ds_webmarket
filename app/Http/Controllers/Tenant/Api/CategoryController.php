<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product};

class CategoryController extends Controller
{
    public function store(Request $request){
		$data = [];
		$datosReq = $request->all(); 
	        
		for ($i = 0; $i < count($datosReq); $i++) 
		{
			$data['codclie'][$i] = @$datosReq[$i]['CodClie'];
			$data['descrip'][$i] = @$datosReq[$i]['Descrip'];
			$data['rif'][$i] = @$datosReq[$i]['Rif'];
			$data['evento'][$i] = @$datosReq[$i]['Evento'];
			$data['email'][$i]     = @$datosReq[$i]['Email'];
			$data['telef'][$i]     = @$datosReq[$i]['Telef'];			
			$data['activo'][$i]     = @$datosReq[$i]['Activo'];

		}
    }
}
