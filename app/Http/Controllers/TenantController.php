<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Tenant};

class TenantController extends Controller
{

    public function index()
    {
        return redirect('home');
    }

    public function create()
    {
        return view('admin.tenant.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|alpha_dash|unique:tenants,id',
            'database' => 'required|string|unique:tenants,data->tenancy_db_name',
            'username' => 'required|string',
            'password' => 'required|string',
            'domain' => 'required|string|unique:domains,domain',
        ]);

        // Crear el tenant
        $tenant = Tenant::create([
            'id' => $request->id,
            'tenancy_db_name' => $request->database, 
            'tenancy_db_username' => $request->username,
            'tenancy_db_password' => $request->password,
        ]);

        // Asociar dominio
        $tenant->domains()->create([
            'domain' => $request->domain,
        ]);

        // Intentar crear la base de datos (opcional y depende de permisos)

        return redirect()->route('tenants.index')->with('success', 'Tenant creado exitosamente.');
    }


    
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
