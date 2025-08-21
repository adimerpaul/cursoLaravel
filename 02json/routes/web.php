<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $usuarios = [
        [
            'name' => 'Adimer',
            'profeciones' => ['Desarrollador', 'Diseñador']
        ],
        [
            'name' => 'Finn'
        ],
        [
            'name' => 'Maria santis',
            'profeciones' => ['Analista']
        ]
    ];
    $num1 = 89;
    $num2 = 20;
    // return response()->json($array);

    return view('greeting', ['name' => 'Adimer', 'usuarios' => $usuarios, 'num1' => $num1, 'num2' => $num2]);
});