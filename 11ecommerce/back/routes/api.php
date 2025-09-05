<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index']);
Route::post('/productos', [App\Http\Controllers\ProductoController::class, 'store']);
Route::delete('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'destroy']);

Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index']);
