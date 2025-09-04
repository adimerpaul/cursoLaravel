<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
class ProductoController extends Controller
{
    function index() {
        $productos = Producto::with('categoria')->get();
        return $productos;
    }
}
