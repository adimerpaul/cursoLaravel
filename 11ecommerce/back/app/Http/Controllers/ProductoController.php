<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
class ProductoController extends Controller
{
    function index() {
        $productos = Producto::with('categoria')->get();
        return $productos;
    }
    function store(Request $request) {
        // $imagen = $request->file('imagen');
        // $ruta = $imagen->store('public/imagenes');
        // $nombreArchivo = basename($ruta);
        //  $request->file('file')->store('uploads', 'public');
        $imagen = $request->file('imagen');
        $nombreArchivo = time() . '_' . $imagen->getClientOriginalName();
        $imagen->move(public_path('imagenes'), $nombreArchivo);
        // $imageBase64 = base64_encode(file_get_contents(public_path('imagenes/' . $nombreArchivo)));

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->codigo_barra = $request->codigo_barra;
        $producto->unidad_medida = $request->unidad_medida;
        $producto->marca = $request->marca;
        $producto->precio_venta_actual = $request->precio_venta_actual;
        $producto->imagen = $nombreArchivo;
        $producto->activo = 1;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();
        return $producto;
    }
    function show($id) {
        $producto = Producto::with('categoria')->find($id);
        if ($producto) {
            return $producto;
        } else {
            return response()->json(['message' => 'Producto no encontrado.'], 404);
        }
    }
    function destroy($id) {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->delete();
            return response()->json(['message' => 'Producto eliminado correctamente.'], 200);
        } else {
            return response()->json(['message' => 'Producto no encontrado.'], 404);
        }
    }
    function update(Request $request, $id) {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->codigo_barra = $request->codigo_barra;
            $producto->unidad_medida = $request->unidad_medida;
            $producto->marca = $request->marca;
            $producto->precio_venta_actual = $request->precio_venta_actual;
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreArchivo = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes'), $nombreArchivo);
                $producto->imagen = $nombreArchivo;
            }
            $producto->categoria_id = $request->categoria_id;
            $producto->save();
            return response()->json(['message' => 'Producto actualizado correctamente.', 'producto' => $producto], 200);
        } else {
            return response()->json(['message' => 'Producto no encontrado.'], 404);
        }
    }
}
