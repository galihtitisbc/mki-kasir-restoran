<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user() == null ? false : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255|regex:/^[a-zA-Z\s]*$/',
            'username'  => 'required|string|max:255|unique:users,username',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'no_hp'     => 'required|numeric|min:5|unique:users,phone',
            'password'  => 'required|min:4',
            'role'      => 'required|string|in:DAPUR,KASIR,ADMIN|regex:/^[a-zA-Z\s]*$/',
            'outlet'    => 'required|array',
            'outlet.*'  => 'required|numeric'
        ];
    }
}
