<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getData()
    {
        // Total pedidos
        $pedidos = 128;

        // Productos más vistos (top 3)
        $populares = collect([
            (object)['nombre' => 'Cámara HD', 'visitas' => 350],
            (object)['nombre' => 'Interruptor WiFi', 'visitas' => 280],
            (object)['nombre' => 'Kit Eléctrico', 'visitas' => 250],
        ]);

        // Clientes activos
        $clientes = 64;

        // Pedidos por estado
        $pedidosPorEstado = [
            'Pendiente' => 14,
            'Confirmado' => 25,
            'Enviado' => 22,
            'Entregado' => 61,
        ];

        // Últimos pedidos (simulación de objetos)
        $ultimosPedidos = collect([
            (object)[
                'id' => 221,
                'cliente' => (object)['nombre' => 'Carlos Mendoza'],
                'created_at' => now()->subDays(1),
            ],
            (object)[
                'id' => 222,
                'cliente' => (object)['nombre' => 'Ana Rivas'],
                'created_at' => now()->subDays(2),
            ],
            (object)[
                'id' => 223,
                'cliente' => (object)['nombre' => 'Pedro Ramírez'],
                'created_at' => now()->subDays(3),
            ],
            (object)[
                'id' => 224,
                'cliente' => (object)['nombre' => 'Laura Gómez'],
                'created_at' => now()->subDays(4),
            ],
            (object)[
                'id' => 225,
                'cliente' => (object)['nombre' => 'Diana Sánchez'],
                'created_at' => now()->subDays(5),
            ],
        ]);

        return compact(
            'pedidos',
            'populares',
            'clientes',
            'pedidosPorEstado',
            'ultimosPedidos'
        );
    }

    public function home(){
        return view('home', $this->getData());
    }

    public function dashboard(){
        return view('tenant.dashboard', $this->getData());

    }
}
