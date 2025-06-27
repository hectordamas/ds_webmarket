<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Setting;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('tenant.admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_human' => 'required|string',
            'color_primary' => 'required|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        // Guardar logo
        if ($request->hasFile('logo')) {
            $filename = 'logo_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('tenancy/assets/uploads'), $filename);
            Setting::updateOrCreate(['key' => 'logo'], ['value' => 'tenancy/assets/uploads/' . $filename]);
        }

        // Guardar número humano
        $human = $request->whatsapp_human;
        Setting::updateOrCreate(['key' => 'whatsapp_human'], ['value' => $human]);

        // Generar URL
        $clean = preg_replace('/\D+/', '', $human);
        $url = 'https://wa.me/' . $clean;
        Setting::updateOrCreate(['key' => 'whatsapp_url'], ['value' => $url]);

        // Color
        Setting::updateOrCreate(['key' => 'color_primary'], ['value' => $request->color_primary]);

        return back()->with('success', 'Configuración actualizada correctamente.');
    }
}