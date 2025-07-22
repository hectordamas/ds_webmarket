<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product};

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Product::all());
    }

    public function store(Request $request){

    }
}
