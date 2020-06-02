<?php

namespace App\Models;

use DateTime;
use Carbon\Carbon;
use App\Http\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
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
    const TAXE_IVA = [10.5,21];
    const TAXE_PERCEP_IVA = [1.5];
    const TAXE_PERCEP_IIBB_SALTA = [3.6,5];
    const TAXE_MUNICIPAL = [2]; 
    /**
     * Atributos asignables de forma masiva..
     *
     * @var array
    */
    protected $fillable = [
        'code',
        'date',
        'user_id',
        'supplier',
        'invoice',
        'total',
        'description',
        'taxe_iva',
        'taxe_percep_iva',
        'taxe_iibb_salta',
        'taxe_municipal'
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
        if(!is_null($request->purchase_code))
        {
            $query = $query->like('code',$request->purchase_code);
        }
        if(!is_null($request->purchase_supplier))
        {
            $query = $query->like('supplier',$request->purchase_supplier);
        }
        if(!is_null($request->purchase_description))
        {
            $query = $query->like('description',$request->purchase_description);
        }
        if(!is_null($request->purchase_invoice))
        {
            $query = $query->like('invoice',$request->purchase_invoice);
        }
        if(!is_null($request->purchase_user_id))
        {
            $query = $query->where('user_id',$request->purchase_user_id);
        }
        if(!is_null($request->purchase_date))
        {
            if($request->purchase_date != self::DATE_DISABLED)
            {
                
                switch($request->purchase_date)
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
                        if(!is_null($request->purchase_date_initial) && !is_null($request->purchase_date_final))
                        {
                            $dateInitial = DateTime::createFromFormat('d-m-Y', $request->purchase_date_initial);
                            $dateInitial = $dateInitial->format('Y-m-d');
                            $dateFinal = DateTime::createFromFormat('d-m-Y', $request->purchase_date_final);
                            $dateFinal = $dateFinal->format('Y-m-d');
                            $query = $query->whereBetween('date',[$dateInitial, $dateFinal]);
                        }
                    break;
                }
            }
        } else {
            $query = $query->where('date',Carbon::now()->format('Y-m-d'));
        }
        if(!is_null($request->purchase_parameter_total) && !is_null($request->purchase_amount_total))
        {
            $query = $query->where('total',$request->purchase_parameter_total,$request->purchase_amount_total);
        }
        return $query;
    }
    public function detailPurchases()
    {
        return $this->hasMany(DetailPurchase::class,'purchase_code','code');
    }

    public function getTotalAttribute($value)
    {
        return number_format($value,2,',');
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
