<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest {

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
            'oldPassword' => ['required'],
            'password' => ['required', 'confirmed', 'min:6', 'max:16'],
        ];
    }

    public function messages() {
        return [
            'oldPassword.required' => 'Contraseña Actual requerida',
            'password.required' => 'Nueva Contraseña requerida',
            'password.min' => 'La Nueva Contraseña debe contener al menos 6 carácteres.',
            'password.max' => 'La Nueva Contraseña debe contener al maximo 16 carácteres',
            'password.confirmed' => 'La confirmación de la Nueva Contraseña no coincide.',
        ];
    }
}