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
        //
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = $request->password;
        }
        $user->save();

        return redirect()->back()->with('success', 'Usuario actualizado con éxito!');
    }


    public function destroy(string $id)
    {
        //
    }
}
