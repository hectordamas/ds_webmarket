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
                $labels = collect(range(0, 23))
                    ->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . 'h')
                    ->toArray();
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

        $pedidosPorEstado = Order::select('status', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
        
        $datosVentas = $this->obtenerDatosVentas($from, $to, $format, $range, $labels);

        return compact(
            'visitas',
            'clientes',
            'products',
            'orders',
            'labels',
            'datosVentas',
            'pedidosPorEstado'
        );
    }

    public function home(Request $request){
        return view('tenant.home', $this->getData($request));
    }
}
