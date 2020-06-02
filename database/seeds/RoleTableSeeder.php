<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'                  => 'Super Administrador',
            'slug'                  => 'super_administrador',
            'description'           => 'Concede acceso a todo el sistema',
            'special_permissions'   => 'all-access',
            'status'                => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
        DB::table('roles')->insert([
            'name'                  => 'Administradora',
            'slug'                  => 'administradora',
            'description'           => 'Concede acceso a todo el sistema excepto a permisos',
            'special_permissions'   => 'all-access',
            'status'                => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
        DB::table('roles')->insert([
            'name'                  => 'Encargada de Ventas y Compras',
            'slug'                  => 'encargada_de_ventas_y_compras',
            'description'           => 'Concede acceso a la gestión de compras, ventas y productos',
            'status'                => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
    }
}
