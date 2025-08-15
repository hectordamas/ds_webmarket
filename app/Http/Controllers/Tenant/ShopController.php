<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category, Product, Setting, Payment, Visit};
use Cart;
class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with(['products' => function ($query) {
            $query->where('active', true)->where('visible', true);
        }])
        ->where('active', true)
        ->where('visible', true)
        ->orderBy('order')
        ->get();        
        
        $settings = Setting::pluck('value', 'key');
        $payments = Payment::all();
    
        $whatsapp_number = preg_replace('/[^0-9]/', '', $settings['whatsapp_human'] ?? '');
        $whatsapp_url = 'https://wa.me/' . $whatsapp_number;

        $ip = $request->ip();
        $hoy = now()->toDateString(); // "2025-07-11"

        $existe = Visit::where('ip', $ip)
            ->whereDate('created_at', $hoy)
            ->exists();

        if (!$existe) {
            Visit::create([
                'ip' => $ip,
                'user_agent' => $request->userAgent(),
                'referrer' => $request->header('referer'),
            ]);
        }
    
        return view('tenant.shop.index', compact('categories', 'settings', 'payments' , 'whatsapp_url'));
    }

}
