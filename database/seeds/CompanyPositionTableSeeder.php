<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CompanyPositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_positions')->insert([
            'id'            => 1,
            'name'          => 'Propietaria',
            'slug'          => 'propietaria',
            'description'   => 'Dueña del negocio',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('company_positions')->insert([
            'id'            => 2,
            'name'          => 'Encargado de Sistemas',
            'slug'          => 'encargado_de_sistemas',
            'description'   => 'Desarrollador y encargado del sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('company_positions')->insert([
            'id'            => 3,
            'name'          => 'Encargado de Ventas y Compras',
            'slug'          => 'encargado_de_ventas_y_compras',
            'description'   => 'Empleado encargado de ventas y compras',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }
}
