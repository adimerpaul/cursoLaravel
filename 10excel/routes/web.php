<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('export', [UsersController::class, 'export']);
Route::get('import', [UsersController::class, 'import']);

