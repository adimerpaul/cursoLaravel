<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;

Route::get('/user', [UserController::class, 'index']);

Route::post('/upload', [UploadController::class, 'upload']);
