<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\CompanyPosition;

class RoleRepository extends BaseRepository
{
    /**
     * Permite enviar una instancia de la clase Role a BaseRepository
     *
     * @return Role Role
     */
    public function getModel()
    {
        return new Role();
    }

    /**
     * Permite crear una instancia de la clase Role.
     *
     * @return Role Role
     */
    public function role()
    {
        $instance = new Role();
        return $instance;
    }

    /**
     * Permite obtener la lista de roles
     * 
     * @param Request $request
     * return Collection $Roles
     */
    public function getListRole($request, $fields = null)
    {
        $roles = $this->role();

        $roles = $roles->search($request)->fields($fields)->orderBy('name','DESC');

        return $roles->paginate($request->per_page);
    }

    /**
     * Permite obtener la lista de roles con los datos básicos id, name y que se encuentren activos
     * @param int|string $status
     * @return Collection $roles
     */
    public function getListRoleBasic($status = null)
    {
        $roles = $this->role()->fields('id,name');
        if (!is_null($status))
        {
            $roles = $roles->status($status);
        }
        return $roles->get();
    }

    /**
     * Devuelve el rol completo y los permisos solo con el id, sirve para mostrar los datos en edit
     *
     * @param int $id
     * @return Model $role
     */
    public function getShowRole($id, $fieldsPermission = null){
        $role = $this->role();
        if(is_null($fieldsPermission))
        {
            $fieldsPermission = 'id,name';
        }
        $role = $role->withLoad(new Permission(),'permissions',$fieldsPermission);
        return $role->findOrFail($id);
    }

    /**
     * Permite llenar los datos del Rol.
     * @param  Request $request
     * @param  int $id
     * @return Model $role
     */
    public function fillModel($request, $id = null) {
        $role = $this->role();
        if(!is_null($id))
        {
            $role = $role->findOrFail($id);
        }

        $role->fill($request->only([
            'name',
            'description',
            'status',
        ]));
        $role->slug = $this->str_replace_name($role->name);
        $role->special_permissions = $this->isSuperRoot($request->permissions); 
        return $role;
    }

        /**
     * Determina si el role es super administrador con acceso total del sistema
     *
     * @param array $permissionsRequest
     * @return string|null
     */
    public function isSuperRoot(array $permissionsRequest)
    {
        $permissionsDB = new Permission();
        $quantityDB = $permissionsDB->count();
        $quantityRequest = count($permissionsRequest);
        return ($quantityDB === $quantityRequest) ? Role::SPECIAL_PERMISSION_ALL_ACCESS : null;
    }
}