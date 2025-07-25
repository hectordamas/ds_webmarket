<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Tenant, User};
use App\Models\Tenant\{Setting};
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
        ]);

        try {
            new \PDO(
                "mysql:host=" . env('DB_HOST') . ";port=" . env('DB_PORT', 3306) . ";dbname=" . $request->database,
                $request->username,
                $request->password // Aquí no necesitas el `filled` porque es nuevo
            );
        } catch (\PDOException $e) {
            return back()->withErrors([
                'database' => '❌ Error al conectar con la base de datos, corrija los datos de conexion e intente nuevamente: ' . $e->getMessage(),
            ])->withInput();
        }

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

        return redirect()->route('tenants.index')->with('success', 'Tenant creado exitosamente.');
    }


    public function edit(string $id)
    {
        $tenant = Tenant::with('domains')->findOrFail($id); 

        // Iniciar contexto tenant
        app(Tenancy::class)->initialize($tenant);   
        
        // Cargar usuarios como objetos
        $users = User::all()->map(function ($user) {
            $clone = clone $user;
            $clone->setConnection(null); // Rompe la conexión al tenant
            return $clone;
        }); 

        $settings = Setting::all()->mapWithKeys(function ($setting) {
            $clone = clone $setting;
            $clone->setConnection(null); // Quita conexión tenant
            return [$clone->key => $clone->value];
        })->toArray();

        // Cerrar contexto tenant
        app(Tenancy::class)->end(); 

        // Retornar vista con modelos "seguros"
        return view('central.admin.tenant.edit', compact('tenant', 'users', 'settings'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'database' => 'required|string',
            'username' => 'required|string',
            'nombre_empresa' => 'required|string',
            'whatsapp_human' => 'required|string',
            'color_primary' => 'required|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $tenant = Tenant::findOrFail($id);

        try {
            new \PDO(
                "mysql:host=" . env('DB_HOST') . ";port=" . env('DB_PORT', 3306) . ";dbname=" . $request->database,
                $request->username,
                $request->filled('password') ? $request->password : $tenant->tenancy_db_password
            );
        } catch (\PDOException $e) {
            return back()->withErrors([
                'database' => '❌ Error al conectar con la base de datos, corrija los datos de conexion e intente nuevamente:' . $e->getMessage(),
            ])->withInput();
        }

        // Actualizar datos JSON del tenant
        DB::table('tenants')->where('id', $id)->update([
            'data' => json_encode([
                'tenancy_db_name' => $request->database,
                'tenancy_db_username' => $request->username,
                'tenancy_db_password' => $request->filled('password') ? $request->password : $tenant->tenancy_db_password,
            ]),
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'nombre_empresa' => $request->nombre_empresa,
            'activo' => $request->has('activo'),
            'updated_at' => now(),
        ]);

        // Actualizar dominio (eliminar anterior y crear nuevo si quieres permitir solo 1 dominio)
        $tenant->domains()->delete(); // elimina el anterior (opcional según lógica)
        $tenant->domains()->create([
            'domain' => $id . '.' . env('CENTRAL_DOMAIN'),
        ]);

        app(Tenancy::class)->initialize($tenant);   
        // Guardar logo en base64
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $base64 = base64_encode(file_get_contents($file));
            $mime = $file->getMimeType();
            $data = 'data:' . $mime . ';base64,' . $base64;
        
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $data]);
        }

        // Guardar número humano
        $human = $request->whatsapp_human;
        Setting::updateOrCreate(['key' => 'whatsapp_human'], ['value' => $human]);

        // Generar URL
        $clean = preg_replace('/\D+/', '', $human);
        $url = 'https://wa.me/' . $clean;
        Setting::updateOrCreate(['key' => 'whatsapp_url'], ['value' => $url]);

        // Color
        Setting::updateOrCreate(['key' => 'color_primary'], ['value' => $request->color_primary]);

        //Redes
        Setting::updateOrCreate(['key' => 'facebook'], ['value' => $request->facebook]);
        Setting::updateOrCreate(['key' => 'instagram'], ['value' => $request->instagram]);

        app(Tenancy::class)->end(); 

        return redirect('home')->with('success', 'Tenant actualizado correctamente.');
    }

    public function toggleActivo(Request $request, Tenant $tenant)
    {
        $tenant->activo = !$tenant->activo;
        $tenant->save();
    
        return response()->json(['success' => true, 'activo' => $tenant->activo]);
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
