<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Tenant\{Visit, Order, Product};
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('tenant.auth');
    }

    private function obtenerRangoYLabels(string $range): array
    {
        $today = Carbon::today();

        switch ($range) {
            case 'week':
                $from = $today->copy()->startOfWeek()->startOfDay();
                $to = $today->copy()->endOfWeek()->endOfDay();
                $format = '%Y-%m-%d';
                $labels = collect(range(0, 6))
                    ->map(fn($i) => ucfirst($from->copy()->addDays($i)->locale('es')->isoFormat('dddd')))
                    ->toArray();
                break;

            case 'month':
                $from = $today->copy()->startOfMonth()->startOfDay();
                $to = $today->copy()->endOfMonth()->endOfDay();
                $format = '%Y-%m-%d';
                $labels = collect(range(1, $to->copy()->day))
                    ->map(fn($d) => str_pad($d, 2, '0', STR_PAD_LEFT))
                    ->toArray();
                break;

            case 'year':
                $from = $today->copy()->startOfYear()->startOfDay();
                $to = $today->copy()->endOfYear()->endOfDay();
                $format = '%Y-%m';
                $labels = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
                break;

            default: // today
                $from = $today->copy()->startOfDay();
                $to = $today->copy()->endOfDay();
                $format = '%H';
                $labels = collect(range(0, 23))->map(function ($h) {
                    return Carbon::createFromTime($h)->format('g A'); // ej: 1 AM, 2 PM
                })->toArray();
                break;
        }

        return compact('from', 'to', 'format', 'labels');
    }

    private function obtenerDatosVentas(Carbon $from, Carbon $to, string $format, string $range, array $labels): array
    {
        $today = Carbon::today();

        $ventas = DB::table('orders')
            ->select(DB::raw("DATE_FORMAT(created_at, '$format') as periodo"), DB::raw('SUM(total) as total'))
            ->whereBetween('created_at', [$from, $to])
            ->where('status', 'Entregado')
            ->groupBy('periodo')
            ->pluck('total', 'periodo')
            ->toArray();

        $datos = [];

        foreach ($labels as $key => $label) {
            switch ($range) {
                case 'year':
                    $clave = $today->year . '-' . str_pad($key + 1, 2, '0', STR_PAD_LEFT);
                    break;
                case 'month':
                    $clave = $today->format('Y-m') . '-' . $label;
                    break;
                case 'week':
                    $clave = $from->copy()->addDays($key)->format('Y-m-d');
                    break;
                default:
                    $clave = str_pad($key, 2, '0', STR_PAD_LEFT);
                    break;
            }

            $datos[] = $ventas[$clave] ?? 0;
        }

        return $datos;
    }

    public function getData($request) {
        $range = $request->input('range') ?? 'today';

        ['from' => $from, 'to' => $to, 'format' => $format, 'labels' => $labels] = $this->obtenerRangoYLabels($range);

        $visitas = Visit::whereBetween('created_at', [$from, $to])->count();

        $clientes = Order::whereBetween('created_at', [$from, $to])
            ->whereNotNull('cedula')
            ->where('cedula', '!=', '')
            ->distinct()
            ->count('cedula');

        $products = Product::count();

        $orders = Order::whereBetween('created_at', [$from, $to])->count();

        $ordenDeseado = ['Pendiente', 'Confirmado', 'Enviado', 'Entregado', 'Cancelado'];

        $pedidosPorEstado = Order::select('status', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $pedidosOrdenados = [];
        foreach ($ordenDeseado as $estado) {
            $pedidosOrdenados[$estado] = $pedidosPorEstado[$estado] ?? 0;
        }

        $datosVentas = $this->obtenerDatosVentas($from, $to, $format, $range, $labels);

        $productosMasVendidos = DB::table('order_products')
        ->select('product_id', DB::raw('SUM(quantity) as total_vendidos'))
        ->whereBetween('created_at', [$from, $to])
        ->groupBy('product_id')
        ->orderByDesc('total_vendidos')
        ->limit(10)
        ->get()
        ->map(function ($item) {
            $producto = Product::find($item->product_id);
            return [
                'nombre' => $producto?->name ?? 'Producto eliminado',
                'cantidad' => $item->total_vendidos,
            ];
        });

        $ingresos = Order::whereBetween('created_at', [$from, $to])
        ->where('status', 'Entregado')
        ->sum('total');

        $ticketPromedio = Order::whereBetween('created_at', [$from, $to])
        ->where('status', 'Entregado')
        ->avg('total');

        $clientesEnRango = Order::whereBetween('created_at', [$from, $to])
            ->whereNotNull('cedula')
            ->where('cedula', '!=', '')
            ->distinct()
            ->pluck('cedula');

        $clientesPorTipo = Order::select('cedula', DB::raw('MIN(created_at) as primera_compra'))
            ->whereNotNull('cedula')
            ->where('cedula', '!=', '')
            ->groupBy('cedula')
            ->get();

        $clientesNuevos = 0;
        $clientesRecurrentes = 0;

        foreach ($clientesPorTipo as $cliente) {
            $tieneCompraEnRango = Order::where('cedula', $cliente->cedula)
                ->whereBetween('created_at', [$from, $to])
                ->exists();
        
            if ($tieneCompraEnRango) {
                if ($cliente->primera_compra >= $from) {
                    $clientesNuevos++;
                } else {
                    $clientesRecurrentes++;
                }
            }
        }

        return compact(
            'visitas',
            'clientes',
            'products',
            'orders',
            'labels',
            'datosVentas',
            'pedidosOrdenados',
            'productosMasVendidos',
            'ingresos',
            'ticketPromedio',
            'clientesNuevos',
            'clientesRecurrentes',
        );
    }

    public function home(Request $request){
        return view('tenant.home', $this->getData($request));
    }
}
