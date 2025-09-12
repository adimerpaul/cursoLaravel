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
        $rol = Rol::where('id', $id)->with('permisos')->first();
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
    function getRolePermisos($id){
        $rol = Rol::where('id', $id)->with('permisos')->first();
        return $rol->permisos;
    }
    function assignPermisoToRole(Request $request, $id){
        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json(['message' => 'Rol not found'], 404);
        }
        $permisoId = $request->input('permiso_id');
        $rol->permisos()->attach($permisoId);
        return response()->json(['message' => 'Permiso assigned to role'], 200);
    }
}
