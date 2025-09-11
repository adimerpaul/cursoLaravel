<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
    function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => ['El usuario o la contraseña son incorrectos.']
            ], 404);
        }
        $token = $user->createToken('web')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
    function profile(Request $request){
        return $request->user();
    }
    function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response([
            'message' => 'Has cerrado sesión'
        ]);
    }
}
