<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    function store(Request $request){

        try {
            DB::beginTransaction();
            $user = $request->user();
            $nota = new Nota();
            $nota->fecha = date('Y-m-d');
            $nota->tipo_nota = 'Venta';
            $nota->impuestos = 0;
            $nota->descuento = 0;
            $nota->total_calculado = 0;
            $nota->estado_nota = 'Cancelado';
            $nota->observaciones = '';
            $nota->user_id = $user->id;
            $nota->cliente_id = $request->cliente_id;
            $nota->save();



            $items = $request->items;
            $total = 0;
            foreach($items as $item){
                $total += $item['precio_unitario'] * $item['cantidad'];
                $movimientos = new \App\Models\Movimiento();
                $movimientos->nota_id = $nota->id;
                $movimientos->producto_id = $item['producto_id'];
                $movimientos->almacen_id = 1;
                $movimientos->cantidad = $item['cantidad'];
                $movimientos->tipo_movimiento = 'Salida';
                $movimientos->precio_unitario_compra = 0;
                $movimientos->precio_unitario_venta = $item['precio_unitario'];
                $movimientos->save();
            }
            $nota->total_calculado = $total;
            $nota->save();
            DB::commit();
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['error' => $e->errors()], 422);
        }
    }
}
