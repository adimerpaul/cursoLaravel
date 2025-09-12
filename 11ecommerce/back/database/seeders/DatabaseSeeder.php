<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\Almacen;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

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

        $permisos = [
            ['name' => 'create_user', 'resource' => 'user', 'action' => 'create', 'detail' => 'Create a new user'],
            ['name' => 'view_user', 'resource' => 'user', 'action' => 'view', 'detail' => 'View user details'],
            ['name' => 'update_user', 'resource' => 'user', 'action' => 'update', 'detail' => 'Update user information'],
            ['name' => 'delete_user', 'resource' => 'user', 'action' => 'delete', 'detail' => 'Delete a user'],
        ];
        foreach ($permisos as $permiso) {
            \DB::table('permisos')->insert($permiso);
        }

        $roles = [
            ['nombre' => 'admin', 'descripcion' => 'Administrator with full access'],
            ['nombre' => 'editor', 'descripcion' => 'Editor with content management permissions'],
            ['nombre' => 'viewer', 'descripcion' => 'Viewer with read-only access'],
        ];
        foreach ($roles as $rol) {
            \DB::table('roles')->insert($rol);
        }
        // asignar permisos a roles
        $rolePermisos = [
            'admin' => ['create_user', 'view_user', 'update_user', 'delete_user'],
            'editor' => ['view_user', 'update_user'],
            'viewer' => ['view_user'],
        ];

        foreach ($rolePermisos as $role => $permisos) {
            $roleId = \DB::table('roles')->where('nombre', $role)->value('id');
            foreach ($permisos as $permiso) {
                $permisoId = \DB::table('permisos')->where('name', $permiso)->value('id');
                \DB::table('permiso_role')->insert([
                    'permiso_id' => $permisoId,
                    'role_id' => $roleId
                ]);
            }
        }
        // asignar roles a usuarios
        $users = User::all();
        foreach ($users as $index => $user) {
            if ($index % 3 == 0) {
                $roleId = \DB::table('roles')->where('nombre', 'admin')->value('id');
            } elseif ($index % 3 == 1) {
                $roleId = \DB::table('roles')->where('nombre', 'editor')->value('id');
            } else {
                $roleId = \DB::table('roles')->where('nombre', 'viewer')->value('id');
            }
            \DB::table('role_user')->insert([
                'role_id' => $roleId,
                'user_id' => $user->id
            ]);
        }

        // Create sucursales
        Sucursal::create([
            'nombre' => 'Sucursal 1',
            'direccion' => 'Calle 1',
            'telefono' => '123456789',
            'ciudad' => 'Ciudad 1'
        ]);
        Sucursal::create([
            'nombre' => 'Sucursal 2',
            'direccion' => 'Calle 2',
            'telefono' => '987654321',
            'ciudad' => 'Ciudad 2'
        ]);

        // Create almacenes
        Almacen::create([
            'nombre' => 'Almacen 1',
            'codigo' => 'ALM001',
            'descripcion' => 'Descripción del Almacen 1',
            'sucursal_id' => 1
        ]);
        Almacen::create([
            'nombre' => 'Almacen 2',
            'codigo' => 'ALM002',
            'descripcion' => 'Descripción del Almacen 2',
            'sucursal_id' => 2
        ]);

        DB::table('sucursal_user')->insert([
            'sucursal_id' => 1,
            'user_id' => 1,
            'role_id' => \DB::table('roles')->where('nombre', 'admin')->value('id'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // create productos fake 1000
        // for ($i = 1; $i <= 1000; $i++) {
        //     Producto::create([
        //         'nombre' => 'Producto ' . $i,
        //         'descripcion' => 'Descripción del producto ' . $i,
        //         'codigo_barra' => '000000000' . $i,
        //         'unidad_medida' => 'unidad',
        //         'marca' => 'Marca ' . $i,
        //         'precio_venta_actual' => rand(10, 500),
        //         'imagen' => null,
        //         'activo' => true,
        //         'categoria_id' => rand(1, 3)
        //     ]);
        // }
    }
}
