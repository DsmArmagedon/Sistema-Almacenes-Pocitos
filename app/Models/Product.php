<?php

namespace App\Models;

use App\Http\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use BaseModel;
    protected $primaryKey = 'code';
    public $incrementing = false;
    const STOCK_INITIAL = 0;
    /**
     * Atributos asignables de forma masiva..
     *
     * @var array
    */
    protected $fillable = [
        'code',
        'description',
        'stock',
        'price',
        'unit',
        'status'
    ];

    /**
     * Atributos llaves
     * @var array
     */
    public static $keysTable = ['code'];

    /**
     * Permite realizar la busqueda o filtro de resultados para enviar al cliente.
     * 
     * @param Builder $query
     * @param Illuminate\Http\Request $request
     * @return Builder $query
     */
    public function scopeSearch($query, $request)
    {
        if(!is_null($request->product_code))
        {
            $query = $query->like('code',$request->product_code);
        }
        if(!is_null($request->product_description))
        {
            $query = $query->like('description',$request->product_description);
        }
        if(!is_null($request->product_parameter_stock) && !is_null($request->product_amount_stock))
        {
            $query = $query->where('stock',$request->product_parameter_stock,$request->product_amount_stock);
        }
        if(!is_null($request->product_parameter_price) && !is_null($request->product_amount_price))
        {
            $query = $query->where('price',$request->product_parameter_price,$request->product_amount_price);
        }
        if(!is_null($request->product_unit))
        {
            $query = $query->like('unit',$request->product_unit);
        }
        if(!is_null($request->product_status))
        {
            $query = $query->where('status',$request->product_status);
        }

        return $query;
    }

    public function detailSales()
    {
        return $this->hasMany(DetailSale::class,'product_code','code');
    }
    /**
     * ACCESORES Y MUTADORES
     */
    /**
     * Cambia a mayusculas el campo description
     * @param string $value
     */
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtoupper($value);
    }

    /**
     * Cambia a mayusculas el campo unit
     * @param string $value
     */
    public function setUnitAttribute($value)
    {
        $this->attributes['unit'] = strtoupper($value);
    }
}
