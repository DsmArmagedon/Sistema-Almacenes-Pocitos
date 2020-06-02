<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * USUARIOS
         */
        DB::table('permissions')->insert([
            'name'          => 'Listar Usuarios o Cargos',
            'slug'          => 'users.index',
            'description'   => 'Permite listar todos los Usuarios o Cargos del sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear Usuario o Cargo',
            'slug'          => 'users.store',
            'description'   => 'Permite crear nuevos Usuarios en el sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver Usuario o Cargo',
            'slug'          => 'users.show',
            'description'   => 'Permite mostrar el detalle de cualquier Usuario o Cargo del sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar Usuario o Cargo',
            'slug'          => 'users.update',
            'description'   => 'Permite editar cualquier dato de un Usuario o Cargo del sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar Usuario o Cargo',
            'slug'          => 'users.destroy',
            'description'   => 'Permite eliminar cualquier Usuario o Cargo del sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        /**
         * ROLES
         */
        DB::table('permissions')->insert([
            'name'          => 'Listar Roles',
            'slug'          => 'roles.index',
            'description'   => 'Permite listar todos los Roles del sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear Rol',
            'slug'          => 'roles.store',
            'description'   => 'Permite crear nuevos Roles en el sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver Rol',
            'slug'          => 'roles.show',
            'description'   => 'Permite mostrar el detalle de cualquier Rol del sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar Rol',
            'slug'          => 'roles.update',
            'description'   => 'Permite editar cualquier dato de un Rol del sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar Rol',
            'slug'          => 'roles.destroy',
            'description'   => 'Permite eliminar cualquier Rol del sistema',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

         /**
          * CARGOS
          */
         DB::table('permissions')->insert([
             'name'        => 'Listar Entradas o Salidas',
             'slug'        => 'inputs-outputs.index',
             'description' => 'Permite listar todos las Entradas o Salidas del sistema',
             'status'      => 1,
             'created_at'  => Carbon::now(),
             'updated_at'  => Carbon::now(),
         ]);
         DB::table('permissions')->insert([
             'name'        => 'Crear Entrada o Salida',
             'slug'        => 'inputs-outputs.store',
             'description' => 'Permite crear nuevas Entradas o Salidas en el sistema',
             'status'      => 1,
             'created_at'  => Carbon::now(),
             'updated_at'  => Carbon::now(),
         ]);
         DB::table('permissions')->insert([
             'name'        => 'Ver Entrada o Salida',
             'slug'        => 'inputs-outputs.show',
             'description' => 'Permite mostrar el detalle de cualquier Entrada o Salida del sistema',
             'status'      => 1,
             'created_at'  => Carbon::now(),
             'updated_at'  => Carbon::now(),
         ]);
         DB::table('permissions')->insert([
             'name'        => 'Editar Entrada o Salida',
             'slug'        => 'inputs-outputs.update',
             'description' => 'Permite editar cualquier dato de un Entrada o Salida del sistema',
             'status'      => 1,
             'created_at'  => Carbon::now(),
             'updated_at'  => Carbon::now(),
         ]);
         DB::table('permissions')->insert([
             'name'        => 'Eliminar Entrada o Salida',
             'slug'        => 'inputs-outputs.destroy',
             'description' => 'Permite eliminar cualquier Entrada o Salida del sistema',
             'status'      => 1,
             'created_at'  => Carbon::now(),
             'updated_at'  => Carbon::now(),
         ]);

        /**
         * PRODUCTOS
         */
        DB::table('permissions')->insert([
            'name'        => 'Listar Productos',
            'slug'        => 'products.index',
            'description' => 'Permite listar todos los Productos del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Crear Producto',
            'slug'        => 'products.store',
            'description' => 'Permite crear nuevos Productos en el sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
//        DB::table('permissions')->insert([
//            'name'        => 'Ver Producto',
//            'slug'        => 'products.show',
//            'description' => 'Permite mostrar el detalle de cualquier Producto del sistema',
//            'status'      => 1,
//            'created_at'  => Carbon::now(),
//            'updated_at'  => Carbon::now(),
//        ]);
        DB::table('permissions')->insert([
            'name'        => 'Editar Producto',
            'slug'        => 'products.update',
            'description' => 'Permite editar cualquier dato de un Producto del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Eliminar Producto',
            'slug'        => 'products.destroy',
            'description' => 'Permite eliminar cualquier Producto del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        
        /**
         * COMPRAS
         */
        DB::table('permissions')->insert([
            'name'        => 'Listar Compras',
            'slug'        => 'purchases.index',
            'description' => 'Permite listar todos las Compras del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Crear Compra',
            'slug'        => 'purchases.store',
            'description' => 'Permite crear nuevas Compras en el sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Ver Compra',
            'slug'        => 'purchases.show',
            'description' => 'Permite mostrar el detalle de cualquier Compra del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Editar Compra',
            'slug'        => 'purchases.update',
            'description' => 'Permite editar cualquier dato de un Compra del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Eliminar Compra',
            'slug'        => 'purchases.destroy',
            'description' => 'Permite eliminar cualquier Compra del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        
        /**
         * VENTAS
         */
        DB::table('permissions')->insert([
            'name'        => 'Listar Ventas',
            'slug'        => 'sales.index',
            'description' => 'Permite listar todos las Ventas del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Crear Venta',
            'slug'        => 'sales.store',
            'description' => 'Permite crear nuevas Venta en el sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Ver Venta',
            'slug'        => 'sales.show',
            'description' => 'Permite mostrar el detalle de cualquier Venta del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Editar Venta',
            'slug'        => 'sales.update',
            'description' => 'Permite editar cualquier dato de un Venta del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
            'name'        => 'Eliminar Venta',
            'slug'        => 'sales.destroy',
            'description' => 'Permite eliminar cualquier Venta del sistema',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        
        DB::table('permissions')->insert([
            'name'        => 'Ver Reportes',
            'slug'        => 'repots.show',
            'description' => 'Permite ver Reportes entre ellos los kardex',
            'status'      => 1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

    }
}
