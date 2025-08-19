<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Customer, Order};

class CustomersController extends Controller
{
    public function getCustomer(Request $request){
        $customer = Customer::where('cedula', $request->cedula)
        ->where('tipo_documento', $request->tipo_documento)
        ->first();

        return response()->json([
            'customer' => $customer
        ]);
    }

    public function getCustomersData()
    {
        $customers = Customer::orderBy('id', 'desc')->get();

        $data = $customers->map(function ($customer) {
            return [
                "id"               => $customer->id,
                "created_at"       => $customer->created_at->format('Y-m-d H:i:s'),
                "updated_at"       => $customer->updated_at->format('Y-m-d H:i:s'),
                "nombre"           => $customer->nombre,
                "cedula"           => $customer->tipo_documento . $customer->cedula,
                "telefono"         => '+58' . $customer->telefono,
                "direccion"        => $customer->direccion . ' ' . $customer->detalle_direccion,
            ];
        });

        $totalRecords = $customers->count();

        $ticketPromedio = Order::where('status', 'Entregado')
            ->avg('total');
        $totalClientes = $totalRecords;
        $nuevosClientesMes = Customer::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $comprasPromedioPorCliente = Order::where('status', 'Entregado')->count() / $totalClientes;

        return response()->json([
            "sEcho" => 1,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data, // 👈 clave que DataTables leer

            "ticketPromedio" => "$" . number_format($ticketPromedio, 2, '.', ','),
            "totalClientes" => $totalClientes,
            "nuevosClientesMes" => $nuevosClientesMes,
            "comprasPromedioPorCliente" => $comprasPromedioPorCliente
        ]);
    }

    public function index(){

        return view('tenant.admin.customers.index');
    }
}
