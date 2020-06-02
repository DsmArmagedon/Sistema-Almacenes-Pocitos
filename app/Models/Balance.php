<?php

namespace App\Models;

use App\Http\Traits\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Balance extends Model
{
    public $timestamps = false;
    use BaseModel;
    /**
     * Atributos asignables de forma masiva.
     * @var array
     */
    protected $fillable = [
        'date',
        'product_code',
        'balance'
    ];
    
    public static function getObjectBalance($code) {
        $objectBalance = self::firstOrCreate(
            [ 'product_code'   => $code, 'date' => Carbon::now()->format('Y-m-').'01'],
            [ 'balance' => 0]
        );
        return $objectBalance;
    }
}
