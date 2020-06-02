<?php

namespace App\Http\Requests;

use App\Rules\AvailabilityOfTheProductRule;
use App\Rules\DatePurchaseSaleRule;
use Illuminate\Foundation\Http\FormRequest;

class InputOutputRequest extends FormRequest {

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
            'date'              => ['required', 'date_format:"d-m-Y"',new DatePurchaseSaleRule()],
            'type'              => ['required', 'in:input,output'],
            'operation'         => ['required', 'max:150'],
            'product_code'      => ['required', 'exists:products,code'],
            'quantity'          => ['required', 'integer']
        ];
    }
    
    public function withValidator($validator)
    {
        if(!$validator->fails()) {
            $this->validate(['product_code' => new AvailabilityOfTheProductRule($this->quantity, $this->type)]);
        }
    }

}
