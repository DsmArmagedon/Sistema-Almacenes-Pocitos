<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\BaseModel;

class Role extends Model
{
    use BaseModel;
    const SPECIAL_PERMISSION_ALL_ACCESS = 'all-access';
    /**
     * Atributos asignables de forma masiva.
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];
    
    /**
     * Atributos llaves
     * @var array
     */
    public static $keysTable = ['id'];

       /**
     * Permite realizar la busqueda o filtro de resultados para enviar al cliente.
     * 
     * @param Builder $query
     * @param Illuminate\Http\Request $request
     * @return Builder $query
     */
    public function scopeSearch($query, $request)
    {
        if(!is_null($request->role_name))
        {
            $query = $query->like('name',$request->role_name);
        }
        if(!is_null($request->role_description))
        {
            $query = $query->like('description',$request->role_description);
        }
        if(!is_null($request->role_status))
        {
            $query = $query->where('status', $request->role_status);
        }

        return $query;
    }

    /**
     * RELACIONES
     */
    
    /**
     * Relacion ORM de uno a muchos de las tablas User - Role.
     * @return collection
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relacion ORM de muchos a muchos de las tablas Roles - Permissions
     * @return collection
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withPivot('permission_id');
    }
}
