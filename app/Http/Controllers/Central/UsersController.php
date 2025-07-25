<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User};

class UsersController extends Controller
{
    
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('central.admin.users.index', [
            'users' => $users
        ]);
    }


    public function create()
    {
        return view('central.admin.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Usuario registrado con éxito!');

    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $user = User::find($id);

        return view('central.admin.users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Usuario actualizado con éxito!');
    }

    public function toggleStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
    
        if ($request->has('field') && in_array($request->field, ['activo'])) {
            $user->{$request->field} = $request->checked;
            $user->save();
        
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Campo no válido'], 400);
    }    


    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        
        return redirect()->back()->with('success', 'Usuario eliminado con éxito!');
    }
}
