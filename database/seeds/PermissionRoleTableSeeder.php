<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = Role::find(1);
        $rango = range(1,30);
        $rol->permissions()->sync($rango);
        $rol = Role::find(2);
        $rango = range(1,15);
        $rol->permissions()->sync($rango);
        $rol = Role::find(3);
        $rango = range(1,5);
        $rol->permissions()->sync($rango);
    }
}
