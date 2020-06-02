<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\BaseModel;

class CompanyPosition extends Model
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
        if(!is_null($request->company_position_name))
        {
            $query = $query->like('name',$request->company_position_name);
        }
        if(!is_null($request->company_position_description))
        {
            $query = $query->like('description',$request->company_position_description);
        }
        if(!is_null($request->company_position_slug))
        {
            $query = $query->like('slug',$request->company_position_slug);
        }
        if(!is_null($request->company_position_status))
        {
            $query = $query->where('status',$request->company_position_status);
        }

        return $query;
    }
}
