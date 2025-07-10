<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant\Product;
use App\Models\Tenant\Category;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        tenant('foo'); // Activar el contexto del tenant

        $categorias = Category::all();

        if ($categorias->isEmpty()) {
            $this->command->warn('No hay categorías registradas. Ejecuta primero el seeder de categorías.');
            return;
        }

        $faker = Faker::create();

        $productosPorCategoria = [
            'Bebidas' => ['Coca-Cola', 'Pepsi', 'Sprite', 'Agua Mineral', 'Jugo de Naranja'],
            'Comidas rápidas' => ['Hamburguesa Clásica', 'Papas Fritas', 'Nuggets', 'Perro Caliente'],
            'Postres' => ['Brownie con Helado', 'Cheesecake', 'Tiramisú', 'Gelatina de Fresa'],
            'Pizzas' => ['Pizza Pepperoni', 'Pizza Margarita', 'Pizza Cuatro Quesos'],
            'Ensaladas' => ['Ensalada César', 'Ensalada Mixta', 'Ensalada Griega'],
            'Jugos naturales' => ['Jugo de Mango', 'Jugo de Patilla', 'Jugo de Fresa'],
            'Café y té' => ['Café Expreso', 'Café Latte', 'Té Verde', 'Capuccino'],
            'Entradas' => ['Tequeños', 'Tostones con queso', 'Arepitas fritas'],
            'Hamburguesas' => ['Hamburguesa Doble Carne', 'Hamburguesa Vegana', 'Hamburguesa BBQ'],
            'Pastas' => ['Pasta Alfredo', 'Pasta Boloñesa', 'Lasaña'],
            'Pollo' => ['Pollo a la brasa', 'Pollo crispy', 'Alitas BBQ'],
            'Carnes' => ['Churrasco', 'Parrilla Mixta', 'Carne en vara'],
            'Mariscos' => ['Camarones al ajillo', 'Paella', 'Ceviche mixto'],
        ];

        foreach ($categorias as $categoria) {
            $productos = $productosPorCategoria[$categoria->name] ?? [];

            if (empty($productos)) {
                // Si no hay productos definidos para esa categoría, generar algunos de ejemplo
                for ($i = 0; $i < 5; $i++) {
                    $nombre = $faker->words(2, true);
                    $productos[] = ucfirst($nombre);
                }
            }

            foreach ($productos as $nombre) {
                $product = Product::create([
                    'name' => $nombre,
                    'slug' => Str::slug($nombre),
                    'description' => 'Delicioso ' . strtolower($nombre) . ' preparado al momento.',
                    'price' => $faker->randomFloat(2, 1, 15),
                    'active' => true,
                    'category_id' => $categoria->id,
                ]);

                $product->image = 'products/' . $product->id . '.jpg';
                $product->save();
            }
        }

        $this->command->info('Productos generados por categoría para el tenant "foo".');
    }
}
