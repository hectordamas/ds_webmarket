<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Product, Category};

class ProductsController extends Controller
{
    public function index(){
        $products = Product::orderBy('id', 'desc')->get();

        return view('tenant.admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('order')->get();

        return view('tenant.admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validar entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Generar slug único
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // Manejo de imagen
        $base64Image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $base64Image = 'data:' . $image->getMimeType() . ';base64,' . base64_encode(file_get_contents($image));
        }

        // Crear el producto
        Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'active' => $request->active,
            'image' => $base64Image,
        ]);

        return redirect('products')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('order')->get();

        return view('tenant.admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Buscar el producto
        $product = Product::findOrFail($id);

        // Validar entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Si el nombre cambió, generar un nuevo slug único
        if ($request->name !== $product->name) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $product->slug = $slug;
        }

        // Manejar imagen nueva si fue subida
        if ($request->hasFile('image')) {
            $filename = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('tenancy/assets/uploads'), $filename);
            $product->image = 'tenancy/assets/uploads/' . $filename;
        }

        // Actualizar los demás campos
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->active = $request->active;
        $product->save();

        return redirect('products')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
    
        // Eliminar imagen si existe
        if ($product->image && File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }
    
        // Eliminar producto
        $product->delete();
    
        return redirect(url('products'))->with('success', 'Producto eliminado correctamente.');
    }

    public function show($id)
    {
        $product = Product::with(['optionGroups.options'])->findOrFail($id);
        $html = view('tenant.shop.components.products.modal-content', [
                'product' => $product
            ])->render();

        return response()->json([
            'success' => true,
            'product' => $product,
            'html' => $html
        ]);
    }
}
