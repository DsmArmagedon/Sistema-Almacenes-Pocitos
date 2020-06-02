<?php

namespace App\Http\Requests;

use App\Models\Sale;
use App\Rules\AlphaSpaceRule;
use App\Rules\DatePurchaseSaleRule;
use App\Rules\UniqueItemArrayRule;
use Carbon\Carbon;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         if($this->method() === self::METHOD_PUT) {
            $dateSale = Sale::findOrFail($this->route('sale'));
            $year = Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            $date = DateTime::createFromFormat('d-m-Y', $dateSale->date);
            $yearValue = $date->format('Y');
            $monthValue = $date->format('m');
            if ($year === $yearValue && $month === $monthValue) {
                return true;
            }
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date'                      => ['required','date_format:"d-m-Y"',new DatePurchaseSaleRule()],
            'client'                    => ['nullable',new AlphaSpaceRule],
            'description'               => ['required', 'max:255'],
            'products'                  => ['required', 'array','bail', new UniqueItemArrayRule('product_code')],
            'products.*.product_code'   => ['required', 'bail', 'max:20'],
            'products.*.price_unit'     => ['required', 'bail', 'numeric', 'min:0'],
            'products.*.quantity'       => ['required', 'bail', 'integer', 'min:1']
        ];
    }
}
