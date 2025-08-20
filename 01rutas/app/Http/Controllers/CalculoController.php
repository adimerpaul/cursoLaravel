<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculoController extends Controller
{
    function tabla9(){
        $numero = 8;
        for ($i = 1; $i <= 10; $i++) {
            echo "$numero * $i = " . ($numero * $i) . "<br>";
        }
    }

    function clientes(){
        $clientes = [
            ['nombre' => 'Juan', 'edad' => 30],
            ['nombre' => 'Maria', 'edad' => 25],
            ['nombre' => 'Pedro', 'edad' => 40]
        ];
        return $clientes;
    }
}
