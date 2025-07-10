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

        // Guardar logo en base64
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $base64 = base64_encode(file_get_contents($file));
            $mime = $file->getMimeType();
            $data = 'data:' . $mime . ';base64,' . $base64;
        
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $data]);
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

        //Redes
        Setting::updateOrCreate(['key' => 'facebook'], ['value' => $request->facebook]);
        Setting::updateOrCreate(['key' => 'instagram'], ['value' => $request->instagram]);


        return back()->with('success', 'Configuración actualizada correctamente.');
    }
}