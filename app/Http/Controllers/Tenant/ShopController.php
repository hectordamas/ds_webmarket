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
        $settings = Setting::pluck('value', 'key');
        $allowOutOfStock = filter_var($settings['allow_out_of_stock'] ?? false, FILTER_VALIDATE_BOOLEAN);

        $categories = Category::with(['products' => function ($query) use ($allowOutOfStock) {
                $query->where('active', true)
                      ->where('visible', true);

                if (!$allowOutOfStock) {
                    $query->where('stock', '>', 0);
                }
            }])
            ->whereHas('products', function ($query) use ($allowOutOfStock) {
                $query->where('active', true)
                      ->where('visible', true);

                if (!$allowOutOfStock) {
                    $query->where('stock', '>', 0);
                }
            })
            ->where('active', true)
            ->where('visible', true)
            ->orderBy('order')
            ->get();        

        $payments = Payment::all();
        
        $whatsapp_number = preg_replace('/[^0-9]/', '', $settings['whatsapp_human'] ?? '');
        $whatsapp_url = 'https://wa.me/' . $whatsapp_number;

        $ip = $request->ip();
        $hoy = now()->toDateString();

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

        return view('tenant.shop.index', compact('categories', 'settings', 'payments', 'whatsapp_url'));
    }

}
