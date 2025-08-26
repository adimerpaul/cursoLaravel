<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller{
    function index(){
        // $categorias = DB::select('select id,nombre from categorias where id = ?', [1]);

        $id = 2;
        $categorias = DB::select('select id,nombre from categorias where id = '.$id);

        // $categorias = DB::table('categorias')->select('id','nombre','descripcion')->get();
        // $categorias = DB::table('categorias')->orderBy('id','desc')->get();
        // $categorias = DB::table('categorias')->where('id', 1)->orWhere('id', 2)->get();

        // $productos = DB::table('productos as p')
        //     ->selectRaw('p.categoria_id, count(*) as total')
        //     ->groupBy('p.categoria_id')
        //     ->get();

        // $categoriasCount = DB::table('categorias')->count();

        // $productoPagination = DB::table('productos')->paginate(2);
        return $categorias;
    }
    function manejeosRollback(){
        DB::beginTransaction();
        try {
            // Código que puede fallar
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Manejo de errores
        }
    }
}
