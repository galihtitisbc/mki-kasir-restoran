<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductCreateRequest extends FormRequest
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
            'product_name'  => 'required|max:255',
            'price'         => 'required|numeric',
            'stock'         => 'nullable|numeric',
            'gambar'        => 'required|image',
            'outlet_id'     => 'required|array',
            'outlet.*'      => 'required|numeric',
            'category_id'   => 'required|array',
            'category.*'    => 'required|numeric'
        ];
    }
}
