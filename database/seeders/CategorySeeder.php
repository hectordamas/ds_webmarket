<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tenant('foo'); // Activar contexto tenant

        $categorias = [
            'Bebidas',
            'Comidas rápidas',
            'Postres',
            'Entradas',
            'Hamburguesas',
            'Pizzas',
            'Pastas',
            'Pollo',
            'Carnes',
            'Mariscos',
        ];

        foreach ($categorias as $i => $nombre) {
            Category::create([
                'name' => $nombre,
                'slug' => Str::slug($nombre),
                'active' => true,
                'order' => $i + 1,
            ]);
        }
    }
}
