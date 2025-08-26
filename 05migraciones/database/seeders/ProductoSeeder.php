<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('productos')->insert([
        //     'nombre' => 'Producto 1',
        //     'descripcion' => 'Descripción del Producto 1',
        //     'precio' => 100.00,
        //     'categoria_id' => 1,
        // ]);
        // DB::table('productos')->insert([
        //     'nombre' => 'Producto 2',
        //     'descripcion' => 'Descripción del Producto 2',
        //     'precio' => 200.00,
        //     'categoria_id' => 2,
        // ]);
        $productos = [
            ['nombre' => 'Producto 1', 'descripcion' => 'Descripción del Producto 1', 'precio' => 100.00, 'categoria_id' => 1],
            ['nombre' => 'Producto 2', 'descripcion' => 'Descripción del Producto 2', 'precio' => 200.00, 'categoria_id' => 2],
            ['nombre' => 'Producto 3', 'descripcion' => 'Descripción del Producto 3', 'precio' => 150.00, 'categoria_id' => 1],
            ['nombre' => 'Producto 4', 'descripcion' => 'Descripción del Producto 4', 'precio' => 250.00, 'categoria_id' => 3],
            ['nombre' => 'Producto 5', 'descripcion' => 'Descripción del Producto 5', 'precio' => 300.00, 'categoria_id' => 2],
        ];

        DB::table('productos')->insert($productos);
    }
}
