<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'show']);
Route::post('/productos', [App\Http\Controllers\ProductoController::class, 'store']);
Route::post('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'update']);
Route::delete('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'destroy']);

Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index']);
Route::post('/categorias', [App\Http\Controllers\CategoriaController::class, 'store']);

Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::post('/users', [App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

Route::post('/auth/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/profile', [App\Http\Controllers\AuthController::class, 'profile']);
    Route::post('/auth/logout', [App\Http\Controllers\AuthController::class, 'logout']);


    Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index']);
});
