<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{ProductOption};

class OptionController extends Controller
{
   public function store(Request $request)
    {
        $validated = $request->validate([
            'product_option_group_id' => 'required|exists:product_option_groups,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0'
        ]);
        
        ProductOption::create($validated);
        
        return redirect()->back()->with('success', 'Opción creada exitosamente');
    }

    public function update(Request $request, ProductOption $option)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0'
        ]);
        
        $option->update($validated);
        
        return redirect()->back()->with('success', 'Opción actualizada exitosamente');
    }

    public function destroy(ProductOption $option)
    {
        $option->delete();
        return redirect()->back()->with('success', 'Opción eliminada exitosamente');
    }
}
