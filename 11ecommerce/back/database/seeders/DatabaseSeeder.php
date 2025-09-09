<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Producto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Categoria::create([
            'nombre' => 'Electrónica',
            'descripcion' => 'Dispositivos electrónicos y gadgets.'
        ]);
        Categoria::create([
            'nombre' => 'Ropa',
            'descripcion' => 'Prendas de vestir para todas las edades.'
        ]);
        Categoria::create([
            'nombre' => 'Hogar',
            'descripcion' => 'Artículos para el hogar y la cocina.'
        ]);

        Producto::create([
            'nombre' => 'Smartphone XYZ',
            'descripcion' => 'Un smartphone con características avanzadas.',
            'codigo_barra' => '1234567890',
            'unidad_medida' => 'unidad',
            'marca' => 'TechBrand',
            'precio_venta_actual' => 699.99,
            'imagen' => null,
            'activo' => true,
            'categoria_id' => 1
        ]);
        // create productos fake 1000
        for ($i = 1; $i <= 1000; $i++) {
            Producto::create([
                'nombre' => 'Producto ' . $i,
                'descripcion' => 'Descripción del producto ' . $i,
                'codigo_barra' => '000000000' . $i,
                'unidad_medida' => 'unidad',
                'marca' => 'Marca ' . $i,
                'precio_venta_actual' => rand(10, 500),
                'imagen' => null,
                'activo' => true,
                'categoria_id' => rand(1, 3)
            ]);
        }
    }
}
