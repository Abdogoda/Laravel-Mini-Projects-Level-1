<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    public function index(){
        $users = User::all();
        return view("users.index", compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view("users.create", compact('roles'));
    }

    public function store(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);
        return back()->with('success', 'User created successfully');
    }

    public function edit(User $user){
        $roles = Role::all();
        return view("users.edit", compact('user', 'roles'));
    }

    public function update(Request $request, User $user){
        $user->update([
            'role_id' => $request->role_id
        ]);
        return back()->with('success', 'User updated successfully');
    }

    public function destroy(User $user){
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}