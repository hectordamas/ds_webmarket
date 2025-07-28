<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Product};

class ImagesController extends Controller
{
    public function upload(){
        return view('tenant.admin.images.upload');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');

            $nombreSinExtension = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $producto = Product::where('sku', $nombreSinExtension)->first();

            if ($producto) {
                $base64Image = 'data:' . $image->getMimeType() . ';base64,' . base64_encode(file_get_contents($image));
                $producto->image = $base64Image;
                $producto->save();

                return response()->json(['message' => 'Imagen cargada correctamente']);
            }

            return response()->json(['error' => 'No se encontró un producto con SKU: ' . $nombreSinExtension], 404);
        }

        return response()->json(['error' => 'No se recibió imagen'], 400);
    }
}
