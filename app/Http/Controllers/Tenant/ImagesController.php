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
        dd($request->all());
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $image) {
                // Obtener el nombre del archivo sin la extensión
                $nombreSinExtension = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                // Buscar producto con SKU que coincida
                $producto = Product::where('sku', $nombreSinExtension)->first();

                if ($producto) {
                    // Convertir imagen a base64
                    $base64Image = 'data:' . $image->getMimeType() . ';base64,' . base64_encode(file_get_contents($image));

                    // Asignar imagen
                    $producto->image = $base64Image;
                    $producto->save();
                }
            }

            return response()->json(['message' => 'Imágenes cargadas correctamente']);
        }

        return response()->json(['error' => 'No se enviaron imágenes'], 400);
    }
}
