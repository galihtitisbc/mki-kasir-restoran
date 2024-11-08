<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BahanUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_bahan' => 'required|string|max:255',
            'harga_bahan_per_satuan' => 'required|numeric',
            'satuan_bahan' => 'required|string|max:255',
            'outlet_id' => 'required|array',
            'outlet_id.*' => 'required|exists:outlets,outlet_id',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
        ];
    }
}
