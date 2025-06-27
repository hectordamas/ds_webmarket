<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{ProductOptionGroup};


class OptionGroupController extends Controller
{
        public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:single,multiple',
            'required' => 'boolean',
            'min_options' => 'nullable|integer|min:0',
            'max_options' => 'nullable|integer|min:0'
        ]);

        ProductOptionGroup::create($validated);

        return redirect()->back()->with('success', 'Grupo creado exitosamente');
    }

    public function update(Request $request, ProductOptionGroup $optionGroup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:single,multiple',
            'required' => 'boolean',
            'min_options' => 'nullable|integer|min:0',
            'max_options' => 'nullable|integer|min:0'
        ]);

        $optionGroup->update($validated);

        return redirect()->back()->with('success', 'Grupo actualizado exitosamente');
    }

    public function destroy(ProductOptionGroup $optionGroup)
    {
        $optionGroup->delete();
        return redirect()->back()->with('success', 'Grupo eliminado exitosamente');
    }
}
