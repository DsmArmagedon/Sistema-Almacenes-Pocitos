<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'code'          => ['required','max:10', Rule::unique('products')->ignore($this->route('product'))],
            'description'   => ['required', 'max:150' ,Rule::unique('products')->ignore($this->route('product'))],
            'price'         => ['required', 'numeric', 'min:0'],
            'unit'          => ['required', 'max:25'],
            'status'        => ['required','boolean']
        ];
    }
}
