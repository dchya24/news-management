<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequestApi;

class LoginRequest extends FormRequestApi
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => 'required',
            "password" => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "Email tidak boleh kosong",
            "password.required" => "Password tidak boleh kosong"
        ];
    }
}
