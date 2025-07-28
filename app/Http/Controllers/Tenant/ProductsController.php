<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Product, Category};
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){

        return view('tenant.admin.products.index');
    }

    public function getProductsData()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->get();

        $data = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'image' => '<a href="#" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal(\'' . img64($product->image) . '\')">
                                <img src="' . img64($product->image) . '" class="img-fluid rounded" style="max-height: 60px;">
                            </a>',
                'sku' => $product->sku ?? 'N/R',
                'name' => $product->name,
                'category' => $product->category->name ?? 'Sin categoría',
                'price' => '$' . number_format($product->price, 2, ',', '.'),
                'stock' => $product->stock < 1
                    ? '<small class="text-danger fw-bold">No Disponible</small>'
                    : '<small class="text-success fw-bold">' . $product->stock . ' Disponible' . ($product->stock > 1 ? 's' : '') . '</small>',
                'estado' => view('tenant.admin.products.partials.estado', ['product' => $product])->render(),
                'acciones' => '<a href="' . url("products/{$product->id}/edit") . '" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                               </a>',
            ];
        });

        $totalInventario = Product::sum(DB::raw('stock * price'));
        $totalDeProductos = Product::count();
        $totalUnidades = Product::sum('stock');
        $productosAgotados = Product::where('stock', 0)->count();

        return response()->json([
            'data' => $data,
            'totalInventario' => '$' . number_format($totalInventario, 2, '.', ','),
            'totalDeProductos' => $totalDeProductos,
            'totalUnidades' => $totalUnidades,
            'productosAgotados' => $productosAgotados
        ]);
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
            'sku' => $request->sku,
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
        // Validar entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            //'category_id' => 'required|exists:categories,id',
            //'active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Buscar el producto
        $product = Product::findOrFail($id);

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
        $base64Image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $base64Image = 'data:' . $image->getMimeType() . ';base64,' . base64_encode(file_get_contents($image));
            $product->image = $base64Image;
        }

        // Actualizar los demás campos
        $product->name = $request->name;
        $product->sku = $request->sku;

        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->active = $request->active;

        $product->save();

        return redirect('products')->with('success', 'Producto actualizado correctamente.');
    }

    public function toggleStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
    
        if ($request->has('field') && in_array($request->field, ['active', 'visible'])) {
            $product->{$request->field} = $request->checked;
            $product->save();
        
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Campo no válido'], 400);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
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
