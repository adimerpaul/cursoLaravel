<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;

class PermisoController extends Controller
{
        function index(){
        return Permiso::all();
    }
    function store(Request $request){
        $permiso = Permiso::create($request->all());
        return response()->json($permiso, 201);
    }
    function show($id){
        $permiso = Permiso::find($id);
        return response()->json($permiso);
    }
    function destroy($id){
        $permiso = Permiso::find($id);
        if ($permiso) {
            $permiso->delete();
            return response()->json(null, 204);
        }
        return response()->json(['message' => 'Permiso not found'], 404);
    }
}
