<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\AlphaSpaceRule;

class UserRequest extends FormRequest
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
        // dd($this);
        return [
            'email'                 => ['required', 'email', Rule::unique('users')->ignore($this->route('user'))],
            'first_name'            => ['required','bail', new AlphaSpaceRule()],
            'last_name'             => ['required','bail', new AlphaSpaceRule()],
            'username'              => ['required', Rule::unique('users')->ignore($this->route('user')),'bail', 'regex:/^[A-Z]{7,12}[0-9]{3}+$/', 'bail','min:10','max:15'],
            'role_id'               => ['required', 'integer'],
            'company_position_id'   => ['required','integer'],
            'address'               => ['required'],
            'phone'                 => ['required'],
            'status'                => ['required', 'boolean']
        ];
    }

    public function messages() {
        return [
            'username.regex'    => 'El campo :attribute tiene formato incorrecto', 
            ];
    }
}
