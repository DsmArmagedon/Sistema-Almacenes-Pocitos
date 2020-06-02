<?php

namespace App\Models;

use App\Http\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;

class DetailPurchase extends Model
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
        'purchase_code',
        'product_code',
        'import',
        'quantity'
    ];

    /**
     * Atributos llaves
     * @var array
     */
    public static $keysTable = ['code','purchase_code','product_code'];

    public function product() {
        return $this->belongsTo(Product::class,'product_code','code');
    }
    
    public function purchase() {
        return $this->belongsTo(Purchase::class,'purchase_code','code');
    }
}
