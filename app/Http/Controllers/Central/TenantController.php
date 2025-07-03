<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Tenant, User};
use Stancl\Tenancy\Tenancy;

class TenantController extends Controller
{
    public function index()
    {
        return redirect('home');
    }

    public function create()
    {
        return view('central.admin.tenant.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:tenants,id',
            'database' => 'required|string',
            'username' => 'required|string',
            'nombre_empresa' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        DB::table('tenants')->insert([
            'id' => $request->id,
            'data' => json_encode([
                'tenancy_db_name' => $request->database,
                'tenancy_db_username' => $request->username,
                'tenancy_db_password' => $request->password,
            ]),
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'nombre_empresa' => $request->nombre_empresa,
            'activo' => $request->has('activo'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Recupera el modelo Tenant como instancia
        $tenant = Tenant::find($request->id);
        
        // Asocia el dominio
       $tenant->domains()->create([
            'domain' => $request->id . '.' . env('CENTRAL_DOMAIN'),
        ]);

        Tenancy::initialize($tenant);

        // 5. Crear el usuario admin dentro del tenant
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 6. Finalizar contexto
        Tenancy::end();

        return redirect()->route('tenants.index')->with('success', 'Tenant creado exitosamente.');
    }


    public function edit(string $id)
    {
        $tenant = Tenant::with('domains')->findOrFail($id);
        return view('central.admin.tenant.edit', compact('tenant'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'database' => 'required|string',
            'username' => 'required|string',
            'nombre_empresa' => 'required|string'
        ]);

        // Actualizar datos JSON del tenant
        DB::table('tenants')->where('id', $id)->update([
            'data' => json_encode([
                'tenancy_db_name' => $request->database,
                'tenancy_db_username' => $request->username,
                'tenancy_db_password' => $request->password,
            ]),
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'nombre_empresa' => $request->nombre_empresa,
            'activo' => $request->has('activo'),
            'updated_at' => now(),
        ]);

        // Actualizar dominio (eliminar anterior y crear nuevo si quieres permitir solo 1 dominio)
        $tenant = Tenant::findOrFail($id);
        $tenant->domains()->delete(); // elimina el anterior (opcional según lógica)
        $tenant->domains()->create([
            'domain' => $id . '.' . env('CENTRAL_DOMAIN'),
        ]);

        return redirect()->route('tenants.index')->with('success', 'Tenant actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        // Eliminar dominios asociados
        $tenant = Tenant::findOrFail($id);
        $tenant->domains()->delete();
    
        // Eliminar tenant
        DB::table('tenants')->where('id', $id)->delete();
    
        return redirect()->route('tenants.index')->with('success', 'Tenant eliminado correctamente.');
    }
}
