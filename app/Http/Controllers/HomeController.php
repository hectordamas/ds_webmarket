<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $tenants = Tenant::all();

        return view('home', compact(
            'tenants'
        ));
    }

}
