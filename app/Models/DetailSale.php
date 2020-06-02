<?php

namespace App\Models;

use App\Http\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    use BaseModel;

    protected $primaryKey = 'code';
    public $incrementing = false;
    /**
     * Atributos asignables de forma masiva..
     *
     * @var array
    */
    protected $fillable = [
        'code',
        'sale_code',
        'product_code',
        'price_unit',
        'quantity'
    ];

    /**
     * Atributos llaves
     * @var array
     */
    public static $keysTable = ['code','sale_code'];

    public function product() {
        return $this->belongsTo(Product::class,'product_code','code');
    }
}
