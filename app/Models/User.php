<?php

namespace App\Models;

use App\Http\Traits\BaseModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable,
        BaseModel;

    /**
     * Atributos asignables de forma masiva..
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'first_name',
        'last_name',
        'address',
        'phone',
        'role_id',
        'company_position_id',
        'status'
    ];

    /**
     * Atributos llaves
     * @var array
     */
    public static $keysTable = ['id', 'role_id', 'company_position_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Permite realizar la busqueda o filtro de resultados para enviar al cliente.
     * 
     * @param Builder $query
     * @param Illuminate\Http\Request $request
     * @return Builder $query
     */
    public function scopeSearch($query, $request) {
        if (!is_null($request->user_username)) {
            $query = $query->like('username', $request->user_username);
        }
        if (!is_null($request->user_email)) {
            $query = $query->like('email', $request->user_email);
        }
        if (!is_null($request->user_first_name)) {
            $query = $query->like('first_name', $request->user_first_name);
        }
        if (!is_null($request->user_last_name)) {
            $query = $query->like('last_name', $request->user_last_name);
        }
        if (!is_null($request->user_address)) {
            $query = $query->like('address', $request->user_address);
        }
        if (!is_null($request->user_phone)) {
            $query = $query->like('phone', $request->user_phone);
        }
        if (!is_null($request->user_company_position_id)) {
            $query = $query->like('company_position_id', $request->company_position_id);
        }
        if (!is_null($request->user_role_id)) {
            $query = $query->where('role_id', $request->user_role_id);
        }
        if (!is_null($request->user_status)) {
            $query = $query->where('status', $request->user_status);
        }

        return $query;
    }

    /**
     * RELACIONES
     */

    /**
     * Relacion ORM de uno a muchos de las tablas User - Role, llave foránea 'ci'.
     * @return collection
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relacion ORM de uno a muchos de las tablas User - CompanyPosition.
     * @return collection
     */
    public function companyPosition() {
        return $this->belongsTo(CompanyPosition::class);
    }

    /**
     * Permite determinar si el usuario logueado posee determinados permisos.
     *
     * @param string|array $permissions
     * @return boolean
     */
    public function isAuthorized($permissions) {
        $role = $this->role()->first();
        if (!is_array($permissions)) {
            foreach ($this->cachedPermissions($role) as $cachePermission) {
                if ($cachePermission === $permissions) {
                    return true;
                }
            }
        } else {
            foreach ($this->cachedPermissions($role) as $cachePermission) {
                if(in_array($cachePermission,$permissions)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Obtiene la cache con los slug del rol que pertenecen al usuario logueado.
     *
     * @param App\Models\Role $role
     * @return collection App\Models\Permissions slug
     */
    public function cachedPermissions($role) {
        // return Cache::rememberForever('role.'.$role->id,function() use ($role){
        // return $role->permissions()->select(['slug'])->get()->toArray();
        return $role->permissions()->pluck('slug');
        // });
    }

    /**
     * ACCESORES Y MUTADORES
     */

    /**
     * Encripta la contraseña, previo a guardar en la base de datos.
     * @param string $value
     */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Permite capitalizar los nombres antes de enviar.
     *
     * @param string $value
     * @return string
     */
    public function getFirstNameAttribute($value) {
        return ucwords($value);
    }

    /**
     * Permite capitalizar los apellidos antes de enviar.
     *
     * @param string $value
     * @return string
     */
    public function getLastNameAttribute($value) {
        return ucwords($value);
    }

    /**
     * Permite crear el atributo full_name los apellidos antes de enviar.
     *
     * @param string $value
     * @return string
     */
    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Convierte los nombres en minusculas, previo a guardar.
     * @param string $value
     */
    public function setFirstNameAttribute($value) {
        $this->attributes['first_name'] = strtolower($value);
    }

    /**
     * Convierte los apellidos en minusculas, previo a guardar.
     * @param string $value
     */
    public function setLastNameAttribute($value) {
        $this->attributes['last_name'] = strtolower($value);
    }

    /**
     * Convierte las direcciones en mayúsculas, previo a guardar.
     * @param string $value
     */
    public function setAddressAttribute($value) {
        $this->attributes['address'] = strtoupper($value);
    }

}
