<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public $timestamps = false;
    const PURCHASE = 'purchases';
    const SALE = 'sales';
    const INPUT_OUTPUT = 'inputs_outputs';
    /**
     * Atributos asignables de forma masiva.
     * @var array
     */
    protected $fillable = [
        'date_code',
        'user_id',
        'sales',
        'purchases',
        'inputs_outputs'
    ];
    
    /**
     * Atributos llaves
     * @var array
     */
    public static $keysTable = ['id'];

    public static function getCode($type)
    {
        $value = self::getObjectCode($type);

//        switch ($type) {
//            case self::PURCHASE:
//                $value = $value->purchases;
//            break;
//            case self::SALE:
//                $value = $value->sales;
//            break;
//            case self::INPUT_OUTPUT:
//                $value = $value->inputs_outputs;
//            break;
//        }
        $value = $value->$type;
        return self::getGenerateCode($type, $value);
        
    }

    public static function getObjectCode($type) {
        $objectCode = self::firstOrCreate(
            [ 'user_id'   => Auth::id(), 'date_code' => Carbon::now()->format('Y-m-d')],
            [ 'purchases' => 0,'sales' => 0,'inputs_outputs' => 0]
        );
        $objectCode->$type = $objectCode->$type + 1;
//        switch ($type) {
//            case self::PURCHASE:
//                $objectCode->purchases = $objectCode->purchases + 1;
//            break;
//            case self::SALE:
//                $objectCode->sales = $objectCode->sales + 1;
//            break;
//            case self::INPUT_OUTPUT:
//                $objectCode->inputs_outputs = $objectCode->inputs_outputs + 1;
//            break;
//        }
        return $objectCode;
    }

    public static function getGenerateCode($type, $value) {
        switch($type)
        {
            case self::PURCHASE:
                $prefix = 'C-';
            break;
            case self::SALE:
                $prefix = 'V-';
            break;
            case self::INPUT_OUTPUT:
                $prefix = 'P-';
            break;
        }
        
        return $prefix. Carbon::now()->format('ymd'). Auth::id().'-'. $value;
    }
}
