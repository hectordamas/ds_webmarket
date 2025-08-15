<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Customer};

class CustomersController extends Controller
{
    public function getCustomer(Request $request){
        $customer = Customer::where('cedula', $request->cedula)
        ->where('tipo_documento', $request->cedula)
        ->first();

        response()->json([
            'customer' => $customer
        ]);
    }
}
