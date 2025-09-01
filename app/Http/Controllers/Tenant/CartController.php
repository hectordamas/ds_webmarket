<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Product, Setting, Payment,Order};
use Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::with('optionGroups.options')->findOrFail($request->product_id);

        $total = $product->price;
        $optionsCart = [];

        $options = $request->input('options', []);

        $requestedQty = $request->input('quantity', 1);

        $currentQtyInCart = Cart::content()
            ->where('id', $product->id)
            ->sum('qty');

        if ($product->stock !== null && ($requestedQty + $currentQtyInCart) > $product->stock) {
            return response()->json([
                "error" => "Stock insuficiente. Quedan " . max(0, $product->stock - $currentQtyInCart) . " unidades disponibles."
            ]);
        }

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
            'options' => ['image' => $product->image, 'extras' => $optionsCart, 'observations' => $request->observations, 'base_price' => $product->price],
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
            'tipo_documento' => 'required|string',
        ]);

        $order = Order::find($request->orderId);

        // Preparar número telefónico
        $telefono = $order->telefono;
        if (!str_starts_with($telefono, '+')) {
            $telefono = '+58' . ltrim($telefono, '0');
        }

        $mensaje = "============================\n";
        $mensaje .= "*ORDEN # {$order->numero_orden}* \n";
        $mensaje .= "============================\n";
        $mensaje .= "*DATOS DEL CLIENTE*\n";
        $mensaje .= "----------------------------------\n";
        $mensaje .= "*Cédula / RIF:* {$order->tipo_documento}{$order->cedula}\n";
        $mensaje .= "*Nombre:* {$order->nombre}\n";
        $mensaje .= "*Teléfono:* {$telefono}\n";

        if ($order->tipo_pedido === 'Delivery') {
            $direccion = trim($order->direccion . ' ' . ( $order->detalle_direccion ?? ''));
            $mensaje .= "*Dirección:* {$direccion}\n";
        } else {
            $mensaje .= "*Dirección:* Para recoger en local\n";
        }

        $mensaje .= "=============================\n";
        $mensaje .= "*CARRITO DE COMPRAS*\n";
        $mensaje .= "=============================\n";

        $total = 0;
        $cantidadTotal = 0;

        foreach ($order->products as $item) {
            $cantidad = $item->quantity;
            $precioTotal = number_format($item->subtotal, 2, '.', ',');
            $nombreProducto = $item->product->name;
            
            $precioUnitario = number_format($item->base_price, 2, '.', ',');

            $mensaje .= "{$nombreProducto}\n";
            $mensaje .= "{$cantidad} x {$precioUnitario} US$ = *{$precioTotal} US$* \n";

            // Primero agrupamos
            $groupedOptions = [];

            foreach ($item->options as $opt) {
                $groupedOptions[$opt->option_group_name][] = "{$opt->option_name} (+$" . number_format($opt->price, 2, '.', ',') . ")";
            }

            // Luego armamos el mensaje
            foreach ($groupedOptions as $groupName => $options) {
                $mensaje .= "  - {$groupName}: " . implode(', ', $options) . "\n";
            }

            // Observaciones
            if ($item->observations) {
                $mensaje .= "  - *Nota:* {$item->observations}\n";
            }

            $mensaje .= "----------------------------------\n";

            $total += $item->unit_price * $cantidad;
            $cantidadTotal += $cantidad;
        }

        $mensaje .= "=====================\n";
        $mensaje .= "*Unidades:* {$cantidadTotal}\n";
        $mensaje .= "*Total:* " . number_format($total, 2, '.', ',') . " US$\n";
        $mensaje .= "=====================\n";

        $payment = Payment::find($order->payment_id);
        $mensaje .= "*Método de pago:* {$order->metodo_pago}\n";
        $mensaje .= "*Tipo de pedido:* {$order->tipo_pedido}\n";

        // Redirigir al número de WhatsApp
        $settings = Setting::pluck('value', 'key');
        $numeroWhatsApp = $settings = Setting::pluck('value', 'key');
        $url = "{$settings['whatsapp_url']}?text=" . urlencode($mensaje);

        return response()->json(['url' => $url]);
    }


}
