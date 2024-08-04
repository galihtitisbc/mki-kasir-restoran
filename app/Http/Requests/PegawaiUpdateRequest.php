<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PegawaiUpdateRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'no_hp'     => 'required|numeric|min:5',
            'password'  => 'nullable|min:4',
            'role'      => 'required|string|in:DAPUR,KASIR,ADMIN|regex:/^[a-zA-Z\s]*$/',
            'outlet'    => 'required|array',
            'outlet.*'  => 'required|numeric'
        ];
    }
}
