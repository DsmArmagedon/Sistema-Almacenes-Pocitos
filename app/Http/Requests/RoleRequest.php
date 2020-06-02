<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaceRule;
use Illuminate\Validation\Rule;
use App\Rules\UniqueItemArrayRule;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name'  => ['required', Rule::unique('roles')->ignore($this->route('role')), new AlphaSpaceRule()],
            'description' => ['nullable',new AlphaSpaceRule()],
            'status'      => ['required','boolean'],
            'permissions' => ['required', 'array','bail', new UniqueItemArrayRule()],
            'permissions.*' => ['required','integer']
        ];
    }
}
