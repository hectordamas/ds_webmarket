<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Customer};

class CustomersController extends Controller
{
    public function getCustomer(Request $request){
        $customer = Customer::where('cedula', $request->cedula)
        ->where('tipo_documento', $request->tipo_documento)
        ->first();

        return response()->json([
            'customer' => $customer
        ]);
    }
}
