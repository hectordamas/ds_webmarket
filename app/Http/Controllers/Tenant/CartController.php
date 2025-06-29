<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Product};
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
}
