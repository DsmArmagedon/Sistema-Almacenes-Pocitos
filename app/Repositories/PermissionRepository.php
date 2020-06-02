<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
class PermissionRepository extends BaseRepository
{
    /**
     * Permite enviar una instancia de la clase Permission a BaseRepository
     *
     * @return Permission Permission
     */
    public function getModel()
    {
        return new Permission();
    }

    /**
     * Permite crear una instancia de la clase Permission.
     *
     * @return Permission Permission
     */
    public function permission()
    {
        $instance = new Permission();
        return $instance;
    }

    /**
     * Permite obtener la lista de permisos
     * 
     * @param Request $request
     * return Collection $permissions
     */
    public function getListPermission()
    {
        $permissions = $this->permission();

        return $permissions->fields('name,description,slug')->status(1)->orderBy('slug','DESC')->get();
    }
}