<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PemilikRestoUpdateRequest extends FormRequest
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
            'username'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'no_hp'     => 'required|numeric|min:5',
            'password'  => 'nullable|min:4',
        ];
    }
}
