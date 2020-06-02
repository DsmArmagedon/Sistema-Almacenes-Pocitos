<?php

namespace App\Http\Requests;

use App\Models\Purchase;
use App\Rules\AlphaSpaceRule;
use App\Rules\DatePurchaseSaleRule;
use App\Rules\UniqueItemArrayRule;
use Carbon\Carbon;
use DateTime;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->method() === self::METHOD_PUT) {
            $datePurchase = Purchase::findOrFail($this->route('purchase'));
            $year = Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            $date = DateTime::createFromFormat('d-m-Y', $datePurchase->date);
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
        $taxeIva = Purchase::TAXE_IVA;
        array_push($taxeIva,0);
        $taxePercepIva = Purchase::TAXE_PERCEP_IVA;
        array_push($taxePercepIva,0);
        $taxeIibbSalta = Purchase::TAXE_PERCEP_IIBB_SALTA;
        array_push($taxeIibbSalta,0);
        $taxeMunicipal = Purchase::TAXE_MUNICIPAL;
        array_push($taxeMunicipal,0);
        return [
            'date'                      => ['required','date_format:"d-m-Y"',new DatePurchaseSaleRule()],
            'supplier'                  => ['nullable',new AlphaSpaceRule],
            'description'               => ['required', 'max:255'],
            'invoice'                   => ['nullable', 'max:50'],
            'taxe_iva'                  => ['required', Rule::in($taxeIva)],
            'taxe_percep_iva'           => ['required', Rule::in($taxePercepIva)],
            'taxe_iibb_salta'           => ['required', Rule::in($taxeIibbSalta)],
            'taxe_municipal'            => ['required', Rule::in($taxeMunicipal)],
            'products'                  => ['required', 'array','bail', new UniqueItemArrayRule('product_code')],
            'products.*.product_code'   => ['required', 'max:20'],
            'products.*.import'         => ['required', 'numeric', 'min:0'],
            'products.*.quantity'       => ['required', 'integer', 'min:1']
        ];
    }
}
