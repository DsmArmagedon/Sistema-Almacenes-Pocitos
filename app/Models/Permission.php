<?php

namespace App\Models;

use App\Http\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use BaseModel;
        /**
     * Atributos asignables de forma masiva.
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status'
    ];
/**
     * Atributos llaves
     * @var array
     */
    public static $keysTable = ['id'];
    /**
     * RELACIONES
     */
    
    /**
     * Relación de muchos a muchos entre Roles y Permissions
     * @return Collection
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withPivot('role_id');
    }

    /**
     * MUTADORES Y ACCESORES
     */
    /**
     * Permite obtener la procedencia del permiso.
     *
     * @param string $value
     * @return string
     */
    public function getTypeAttribute($value)
    {
        list($type,$action) = explode('.',$this->slug); 
        return $type;
    }
}
