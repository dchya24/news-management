<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequestApi;

class RegisterRequest extends FormRequestApi
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
            "name" => 'required',
            "email" => 'required',
            "password" => 'required|confirmed',
            "password_confirmation" => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Name tidak boleh kosong",
            "email.required" => "Email tidak boleh kosong",
            "password.required" => "Password tidak boleh kosong",
            "password.confirmed" => "Konfirmasi password tidak sama",
            "password_confirmation.required" => "Konfirmasi password tidak boleh kosong",
        ];
    }
}
