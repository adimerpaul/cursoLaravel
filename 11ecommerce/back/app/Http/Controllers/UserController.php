<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function index() {
        return User::all();
    }
    function show($id) {
        return User::find($id);
    }
}
