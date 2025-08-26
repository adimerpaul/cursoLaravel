<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Computadoras', 'descripcion' => 'Todo sobre computadoras'],
            ['nombre' => 'Impresoras', 'descripcion' => 'Todo sobre impresoras'],
            ['nombre' => 'Accesorios', 'descripcion' => 'Todo sobre accesorios'],
        ];

        DB::table('categorias')->insert($categorias);
    }
}
