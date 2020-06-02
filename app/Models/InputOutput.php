<?php

namespace App\Models;

use App\Http\Traits\BaseModel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class InputOutput extends Model
{
    use BaseModel;
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $table = 'inputs_outputs';
    const INPUT = 'input';
    const OUTPUT = 'output';
    const DATE_DAY = 'date_day';
    const DATE_MONTH = 'date_month';
    const DATE_YEAR = 'date_year';
    const DATE_RANGE = 'date_range';
    const DATE_DISABLED = 'disabled';
    /**
     * Atributos asignables de forma masiva..
     *
     * @var array
    */
    protected $fillable = [
        'code',
        'date',
        'operation',
        'product_code',
        'type',
        'quantity'
    ];

    /**
     * Atributos llaves
     * @var array
     */
    public static $keysTable = ['code', 'product_code'];
    
        /**
     * Permite realizar la busqueda o filtro de resultados para enviar al cliente.
     * 
     * @param Builder $query
     * @param Request $request
     * @return Builder $query
     */
    public function scopeSearch($query, $request)
    {
        if(!is_null($request->input_output_code))
        {
            $query = $query->like('code',$request->input_output_code);
        }
        if(!is_null($request->input_output_operation))
        {
            $query = $query->like('operation',$request->input_output_operation);
        }
        if(!is_null($request->input_output_type))
        {
            $query = $query->where('type',$request->input_output_type);
        }
        if(!is_null($request->input_output_date))
        {
            if($request->input_output_date != self::DATE_DISABLED)
            {
                
                switch($request->input_output_date)
                {
                    case self::DATE_DAY:
                        $query = $query->where('date',Carbon::now()->format('Y-m-d'));
                    break;
                    case self::DATE_MONTH:
                        $query = $query->whereMonth('date', Carbon::now()->format('m'))->whereYear('date',Carbon::now()->format('Y'));
                    break;
                    case self::DATE_YEAR:
                        $query = $query->whereYear('date', Carbon::now()->format('Y'));
                    break;
                    case self::DATE_RANGE:
                        $query = $query->dateRange($request->input_output_date_initial, $request->input_output_date_final);
                    break;
                }
            }
        } else {
            $query = $query->whereMonth('date', Carbon::now()->format('m'))->whereYear('date',Carbon::now()->format('Y'));
        }
        if(!is_null($request->input_output_parameter_quantity) && !is_null($request->input_output_amount_quantity))
        {
            $query = $query->where('quantity',$request->input_output_parameter_quantity,$request->input_output_amount_quantity);
        }
        return $query;
    }
    
    public function product() {
        return $this->belongsTo(Product::class,'product_code','code');
    }
    public function getDateAttribute($value)
    {
        $date = new DateTime($value);
        return $date->format('d-m-Y');
    }

    public function setDateAttribute($value)
    {
        $date = DateTime::createFromFormat('d-m-Y', $value);
        $this->attributes['date'] = $date->format('Y-m-d');
    }
}
