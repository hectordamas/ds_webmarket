<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product, Setting, Payment};

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->where('active', true)->orderBy('order')->get();
        $settings = Setting::pluck('value', 'key');
        $payments = Payment::all();
    
        $whatsapp_number = preg_replace('/[^0-9]/', '', $settings['whatsapp_human'] ?? '');
        $whatsapp_url = 'https://wa.me/' . $whatsapp_number;
    
        return view('tenant.shop.index', compact('categories', 'settings', 'payments' , 'whatsapp_url'));
    }

}
