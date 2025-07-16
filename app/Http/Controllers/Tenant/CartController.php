<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Product, Setting, Payment};
use Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::with('optionGroups.options')->findOrFail($request->product_id);

        $total = $product->price;
        $optionsCart = [];

        $options = $request->input('options', []);

        foreach ($product->optionGroups as $group) {
            $selected = $options[$group->id] ?? null;

            if ($group->type === 'multiple') {
                if (!is_array($selected)) {
                    $selected = $selected ? [$selected] : []; // convertir en array solo si hay algo
                }
            
                $count = count($selected);
            
                if ($group->required && $count === 0) {
                    return response()->json(["error" => 'El campo "'. $group->name .'" es obligatorio.']);
                }
            
                if ($group->min_options && $count < $group->min_options) {
                    return response()->json(["error" => 'Debes seleccionar al menos "'. $group->min_options.'" opciones de "'.$group->name.'" ']);
                }
            
                if ($group->max_options && $count > $group->max_options) {
                    return response()->json(["error" => 'Solo puedes seleccionar hasta "'. $group->max_options.'" opciones de "'.$group->name.'" ']);
                }
            
                $selectedOptions = [];
                foreach ($group->options->whereIn('id', $selected) as $option) {
                    $total += $option->price;
                    $selectedOptions[] = $option->name . ($option->price > 0 ? ' (+$' . number_format($option->price, 2) . ')' : '');
                }
            
                $optionsCart[$group->name] = $selectedOptions;
            
            }  elseif ($group->type === 'single') {
                if (is_array($selected)) {
                    $selected = $selected[0] ?? null;
                }
            
                if ($group->required && ($selected === null || $selected === '')) {
                    return response()->json(["error" => "Debes seleccionar una opción para '{$group->name}'"]);
                }
            
                $option = $group->options->firstWhere('id', $selected);
                if ($option) {
                    $total += $option->price;
                    $optionsCart[$group->name] = [
                        $option->name . ($option->price > 0 ? ' (+$' . number_format($option->price, 2) . ')' : '')
                    ];
                }
            }
        }

        // Agregar al carrito
        $item = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->input('quantity', 1),
            'price' => $total,
            'options' => ['image' => $product->image, 'extras' => $optionsCart, 'observations' => $request->observations],
            'weight' => 0
        ]);

        $items = view('tenant.shop.components.cart.items')->render();
        $buttonContent = view('tenant.shop.components.cart.button-content')->render();
        $resumenCart = view('tenant.shop.components.cart.resumen-cart')->render();

        return response()->json([
            "success" => "Producto agregado al carrito",
            "items" => $items,
            "buttonContent" => $buttonContent,
            'cartItems' => Cart::content(),
            'item' => $item,
            'resumenCart' => $resumenCart
        ]);
    }

    public function remove(Request $request)
    {
        $rowId = $request->rowId;
    
        if ($rowId && Cart::get($rowId)) {
            Cart::remove($rowId);
        }
    
        $items = view('tenant.shop.components.cart.items')->render();
        $buttonContent = view('tenant.shop.components.cart.button-content')->render();
        $resumenCart = view('tenant.shop.components.cart.resumen-cart')->render();

        return response()->json([
            'success' => true,
            'items' => $items,
            'buttonContent' => $buttonContent,
            'resumenCart' => $resumenCart
        ]);
    }

    public function destroy(){
        Cart::destroy();
        
        $items = view('tenant.shop.components.cart.items')->render();
        $buttonContent = view('tenant.shop.components.cart.button-content')->render();
        $resumenCart = view('tenant.shop.components.cart.resumen-cart')->render();

        return response()->json([
            'success' => true,
            'items' => $items,
            'buttonContent' => $buttonContent,
            'resumenCart' => $resumenCart
        ]);
    }

    public function enviarWhatsapp(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'cedula' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'nullable|string',
            'detalle_direccion' => 'nullable|string',
            'metodo_pago' => 'required|string',
            'tipo_pedido' => 'required|string',
        ]);

        $pedidoId = rand(1000, 9999);

        // Preparar número telefónico
        $telefono = $data['telefono'];
        if (!str_starts_with($telefono, '+')) {
            $telefono = '+58' . ltrim($telefono, '0');
        }

        $mensaje = "============================\n";
        $mensaje .= "*ORDEN N.º {$pedidoId}* \n";
        $mensaje .= "============================\n";
        $mensaje .= "*DATOS DEL CLIENTE*\n";
        $mensaje .= "----------------------------------\n";
        $mensaje .= "*Cédula / RIF:* {$data['tipo_documento']} {$data['cedula']}\n";
        $mensaje .= "*Nombre:* {$data['nombre']}\n";
        $mensaje .= "*Teléfono:* {$telefono}\n";

        if ($data['tipo_pedido'] === 'delivery') {
            $direccion = trim($data['direccion'] . ' ' . ($data['detalle_direccion'] ?? ''));
            $mensaje .= "*Dirección:* {$direccion}\n";
        } else {
            $mensaje .= "*Dirección:* Para recoger en local\n";
        }

        $mensaje .= "=============================\n";
        $mensaje .= "*CARRITO DE COMPRAS*\n";
        $mensaje .= "=============================\n";

        $total = 0;
        $cantidadTotal = 0;

        foreach (Cart::content() as $item) {
            $cantidad = $item->qty;
            $precioUnitario = number_format($item->price, 2, '.', ',');
            $precioTotal = number_format($item->price * $cantidad, 2, '.', ',');
            $nombreProducto = $item->name;

            $mensaje .= "{$nombreProducto}\n";
            $mensaje .= "{$cantidad} x {$precioUnitario} US$ = *{$precioTotal} US$* \n";

            // Extras
            foreach ($item->options->extras as $grupo => $opciones) {
                $mensaje .= "  - {$grupo}: " . implode(', ', $opciones) . "\n";
            }

            // Observaciones
            if ($item->options->observations) {
                $mensaje .= "  - *Nota:* {$item->options->observations}\n";
            }

            $mensaje .= "----------------------------------\n";

            $total += $item->price * $cantidad;
            $cantidadTotal += $cantidad;
        }

        $mensaje .= "=====================\n";
        $mensaje .= "*Unidades:* {$cantidadTotal}\n";
        $mensaje .= "*Total:* " . number_format($total, 2, '.', ',') . " US$\n";
        $mensaje .= "=====================\n";

        $payment = Payment::find($data['metodo_pago']);
        $mensaje .= "*Método de pago:* {$payment->name}\n";
        $mensaje .= "*Tipo de pedido:* {$data['tipo_pedido']}\n";

        // Redirigir al número de WhatsApp
        $settings = Setting::pluck('value', 'key');
        $numeroWhatsApp = $settings = Setting::pluck('value', 'key');
        $url = "{$settings['whatsapp_url']}?text=" . urlencode($mensaje);

        return response()->json(['url' => $url]);
    }


}
