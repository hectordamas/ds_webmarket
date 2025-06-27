<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Category};

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::orderBy('order')->get();    

        return view('tenant.admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create(){
        return view('tenant.admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'required|boolean',
        ]);

        // Generar el slug base
        $slugBase = Str::slug($request->name);
        $slug = $slugBase;

        $count = 1;
        // Asegurar unicidad del slug
        while (Category::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $count++;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'active' => $request->active,
        ]);

        return redirect('categories')->with('success', 'Categoría creada exitosamente.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('tenant.admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'required|boolean',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'active' => $request->active,
        ]);

        return redirect('categories')->with('success', 'Categoría actualizada correctamente.');
    }

    public function sort(Request $request)
    {
        foreach ($request->order as $item) {
            Category::where('id', $item['id'])->update(['order' => $item['position']]);
        }

        return response()->json(['message' => 'Orden actualizado correctamente.']);
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    
        return redirect('categories')->with('success', 'Categoría eliminada correctamente.');
    }
}
