<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    function index() {
        return Cliente::with('notas')->get();
    }
    function store(Request $request) {
        $cliente = Cliente::create($request->all());
        return $cliente;
    }
    function update(Request $request, $id) {
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->update($request->all());
            return response()->json($cliente, 200);
        } else {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
    }
    function destroy($id) {
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->delete();
            return response()->json(['message' => 'Cliente eliminado'], 200);
        } else {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
    }
}
