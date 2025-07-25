<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stancl\Tenancy\Tenancy;
use App\Models\{Tenant, User};

class TenantUserController extends Controller
{
    public function store(Request $request){
        $tenant = Tenant::find($request->tenant_id);

        app(Tenancy::class)->initialize($tenant);   

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        app(Tenancy::class)->end(); 

        return redirect()->back()->with('success', 'Usuario registrado con éxito');
    }

    public function update(Request $request){
        $tenant = Tenant::find($request->tenant_id);

        app(Tenancy::class)->initialize($tenant); 

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        app(Tenancy::class)->end(); 

        return redirect()->back()->with('success', 'Usuario modificado con éxito');

    }

    public function toggleStatus(Request $request)
    {
        $tenant = Tenant::find($request->tenantId);

        app(Tenancy::class)->initialize($tenant); 

        $user = User::findOrFail($request->id);
    
        if ($request->has('field') && in_array($request->field, ['activo'])) {
            $user->{$request->field} = $request->checked;
            $user->save();

            app(Tenancy::class)->end(); 
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Campo no válido'], 400);
    }    


    public function destroy(Request $request){
        $tenant = Tenant::find($request->tenant_id);
        app(Tenancy::class)->initialize($tenant); 

        $user = User::find($request->id);        
        $user->delete();

        app(Tenancy::class)->end(); 

        return redirect()->back()->with('success', 'Usuario eliminado con éxito');
    }
}
