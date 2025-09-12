<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;

class AlmacenController extends Controller
{
    public function index(){
        return Almacen::all();
    }
    public function store(Request $request){
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'sucursal_id' => 'required|exists:sucursales,id',
        ]);
        Almacen::create($request->all());
        return response()->json(['message' => 'Almacen creado exitosamente'], 201);
    }
}
