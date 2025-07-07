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

    public function destroy(Request $request){
        $tenant = Tenant::find($request->tenant_id);
        app(Tenancy::class)->initialize($tenant); 

        $user = User::find($request->id);        
        $user->delete();

        app(Tenancy::class)->end(); 

        return redirect()->back()->with('success', 'Usuario eliminado con éxito');
    }
}
