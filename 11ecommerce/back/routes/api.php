<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index']);
Route::get('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'show']);
Route::post('/productos', [App\Http\Controllers\ProductoController::class, 'store']);
Route::post('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'update']);
Route::delete('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'destroy']);

Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index']);
Route::post('/categorias', [App\Http\Controllers\CategoriaController::class, 'store']);

Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
