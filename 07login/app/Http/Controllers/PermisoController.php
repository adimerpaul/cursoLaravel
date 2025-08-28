<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermisoController extends Controller{
    function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'resource' => 'required|string|max:255',
            'action' => 'required|string|max:255',
            'detail' => 'nullable|string',
        ]);

        $permiso = \App\Models\Permiso::create($validated);

        return response()->json(['permiso' => $permiso], 201);
    }
    function index(Request $request){
        $permisos = \App\Models\Permiso::all();
        return response()->json(['permisos' => $permisos], 200);
    }

}
