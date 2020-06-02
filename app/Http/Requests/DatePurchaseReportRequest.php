<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Purchase;
use Illuminate\Validation\Rule;

class DatePurchaseReportRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'purchase_date' => ['required'],
            'purchase_date_initial' => [Rule::requiredIf(function() {
                            return $this->purchase_date === Purchase::DATE_RANGE;
                        }), 'nullable', 'date_format:"d-m-Y"'],
            'purchase_date_final' => [Rule::requiredIf(function() {
                            return $this->purchase_date === Purchase::DATE_RANGE;
                        }), 'nullable', 'date_format:"d-m-Y"'],
            'sale_month' => [Rule::requiredIf(function() {
                            return $this->purchase_date === Purchase::DATE_YEAR_MONTH;
                        }), 'nullable', 'integer', 'min:1', 'max:12']
        ];
    }

    public function messages() {
        return [
            'purchase_date.required' => 'El campo Fecha es obligatorio',
            'purchase_month.required' => 'Es obligatorio que seleccione un mes si desea el reporte de compras por mes del año en curso',
        ];
    }

}
