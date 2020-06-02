<?php

namespace App\Models;

use DateTime;
use Carbon\Carbon;
use App\Models\DetailSale;
use App\Http\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use BaseModel;
    protected $primaryKey = 'code';
    public $incrementing = false;
    const DATE_DAY = 'date_day';
    const DATE_MONTH = 'date_month';
    const DATE_YEAR = 'date_year';
    const DATE_RANGE = 'date_range';
    const DATE_YEAR_MONTH = 'date_year_month';
    const DATE_DISABLED = 'disabled';
    /**
     * Atributos asignables de forma masiva.
     * @var array
     */
    protected $fillable = [
        'code',
        'date',
        'user_id',
        'client',
        'total',
        'description'
    ];
    
    /**
     * Atributos llaves
     * @var array
     */
    public static $keysTable = ['code', 'user_id'];

    /**
     * Permite realizar la busqueda o filtro de resultados para enviar al cliente.
     * 
     * @param Builder $query
     * @param Illuminate\Http\Request $request
     * @return Builder $query
     */
    public function scopeSearch($query, $request)
    {
        if(!is_null($request->sale_code))
        {
            $query = $query->like('code',$request->sale_code);
        }
        if(!is_null($request->sale_client))
        {
            $query = $query->like('client',$request->sale_client);
        }
        if(!is_null($request->sale_description))
        {
            $query = $query->like('description',$request->sale_description);
        }
        if(!is_null($request->sale_user_id))
        {
            $query = $query->where('user_id',$request->sale_user_id);
        }
        if(!is_null($request->sale_date))
        {
            if($request->sale_date != self::DATE_DISABLED)
            {
                
                switch($request->sale_date)
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
                        if(!is_null($request->sale_date_initial) && !is_null($request->sale_date_final))
                        {
                            $dateInitial = DateTime::createFromFormat('d-m-Y', $request->sale_date_initial);
                            $dateInitial = $dateInitial->format('Y-m-d');
                            $dateFinal = DateTime::createFromFormat('d-m-Y', $request->sale_date_final);
                            $dateFinal = $dateFinal->format('Y-m-d');
                            $query = $query->whereBetween('date',[$dateInitial, $dateFinal]);
                        }
                    break;
                }
            }
        } else {
            $query = $query->where('date',Carbon::now()->format('Y-m-d'));
        }
        if(!is_null($request->sale_parameter_total) && !is_null($request->sale_amount_total))
        {
            $query = $query->where('total',$request->sale_parameter_total,$request->sale_amount_total);
        }
        return $query;
    }

    public function detailSales()
    {
        return $this->hasMany(DetailSale::class,'sale_code','code');
    }
    public function getTotalAttribute($value)
    {
        return number_format($value,2,',','.');
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
