<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller{
    function upload(Request $request){
        $request->validate([
            'file' => 'required|file|max:2048', // Máximo 2MB
        ]);

        if ($request->file('file')->isValid()) {
            // $path = $request->file('file')->store('uploads', 'public'); upload public
            $filename = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('images/'), $filename);
            return response()->json(['message' => 'Archivo subido exitosamente', 'path' => $filename], 200);
        }

        return response()->json(['message' => 'Error al subir el archivo'], 400);
    }
}
