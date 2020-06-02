<?php

namespace App\Http\Requests;

use App\Models\Sale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DateSaleReportRequest extends FormRequest {

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
            'sale_date' => ['required'],
            'sale_date_initial' => [Rule::requiredIf(function() {
                            return $this->sale_date === Sale::DATE_RANGE;
                        }), 'nullable', 'date_format:"d-m-Y"'],
            'sale_date_final' => [Rule::requiredIf(function() {
                            return $this->sale_date === Sale::DATE_RANGE;
                        }), 'nullable', 'date_format:"d-m-Y"'],
            'sale_month' => [Rule::requiredIf(function() {
                            return $this->sale_date === Sale::DATE_YEAR_MONTH;
                        }), 'nullable', 'integer', 'min:1', 'max:12']
        ];
    }

    public function messages() {
        return [
            'sale_date.required' => 'El campo Fecha es obligatorio',
            'sale_month.required' => 'Es obligatorio que seleccione un mes si desea el reporte de ventas por mes del año en curso',
        ];
    }

}
