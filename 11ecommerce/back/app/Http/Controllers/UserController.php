<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function getUserRoles($id) {
        $user = User::find($id);
        return $user->roles;
    }
    function assignRole(Request $request, $id) {
        $user = User::find($id);
        $user->roles()->syncWithoutDetaching([$request->role_id]);
        return $user->roles;
    }
    function index() {
        return User::with('roles')->get();
    }
    function show($id) {
        return User::with('roles')->find($id);
    }
    function store(Request $request) {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }
    function update(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return $user;
    }
    function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return "Usuario eliminado";
    }
}
