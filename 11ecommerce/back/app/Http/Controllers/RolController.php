<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller{
    function index(){
        return Rol::all();
    }
    function store(Request $request){
        $rol = Rol::create($request->all());
        return response()->json($rol, 201);
    }
    function show($id){
        $rol = Rol::find($id);
        return response()->json($rol);
    }
    function destroy($id){
        $rol = Rol::find($id);
        if ($rol) {
            $rol->delete();
            return response()->json(null, 204);
        }
        return response()->json(['message' => 'Rol not found'], 404);
    }
}
