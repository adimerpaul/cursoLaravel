<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    function index(){
        return response()->json(\App\Models\Cliente::all());
    }
}
