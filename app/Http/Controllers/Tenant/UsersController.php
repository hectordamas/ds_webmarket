<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('tenant.admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('tenant.admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect('usuarios')->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $user)
    {
        return view('tenant.admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect('usuarios')->with('success', 'Usuario actualizado');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('usuarios')->with('success', 'Usuario eliminado');
    }
}
