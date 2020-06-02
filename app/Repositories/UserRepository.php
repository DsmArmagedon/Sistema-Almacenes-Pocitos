<?php

namespace App\Repositories;

use App\Models\CompanyPosition;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class UserRepository extends BaseRepository
{
    protected $roleR;
    protected $companyPositionR;
    /**
     * Permite enviar una instancia de la clase User a BaseRepository
     *
     * @return User User
     */
    public function getModel()
    {
        return new User();
    }

    /**
     * Permite crear una instancia de la clase User.
     *
     * @return User User
     */
    public function user()
    {
        $instance = new User();
        return $instance;
    }

    /**
     * Permite obtener la lista de usuarios
     * 
     * @param Request $request
     * return Collection $users
     */
    public function getListUser($request, $fields = null)
    {
        $users = $this->user();

        $users = $users->whereHasWithLoad(new Role(),'role',$request,'id,name');
        $users = $users->search($request)->fields($fields)->orderBy('updated_at','DESC');
        return $users->paginate($request->per_page );
    }

    /**
     * Permite ver en detalle la informacion del USUARIO.
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     * @return Model $user
     */
    public function getShowUser($id)
    {   
        $user = $this->user();
        $user = $user->withLoad(new Role(),'role','id,name')->withLoad(new CompanyPosition(),'companyPosition','id,name');
        return $user->findOrFail($id);
    }
    /**
     * Permite llenar los datos del Usuario.
     * @param  Request $request
     * @param  User $id
     * @return User
     */
    public function fillModel($request, $id = null) {
        $user = $this->user();
        if(!is_null($id))
        {
            $user = $user->findOrFail($id);
        } else {
            $user->password = $this->getPassword($request->first_name,$request->last_name);
        }

        $user->fill($request->only([
            'first_name',
            'last_name',
            'username',
            'email',
            'address',
            'phone',
            'status',
            'role_id',
            'company_position_id'
        ]));
        return $user;
    }

    /**
     * Permite obtener la contraseña por defecto de cada usuario.
     * @param  string $firstName
     * @param  string $lastName
     * @return string $code
     */
    public function getPassword($firstName, $lastName)
    {
        $code = substr($firstName, 0, 3) . '.';
        $code .= substr($lastName, 0, 3);
        return strtolower($code);
    }
}