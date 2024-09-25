<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PemilikRestoCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->roles->pluck('name')[0] == 'SUPERADMIN' ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users,username',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'no_hp'     => 'required|numeric|min:5|unique:users,phone',
            'password'  => 'required|min:5|regex:/[a-zA-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus memiliki minimal :min karakter.',
            'password.regex' => 'Password harus mengandung huruf, angka, dan karakter spesial (@$!%*#?&).',
        ];
    }
}
