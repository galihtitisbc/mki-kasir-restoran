<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BahanProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'bahan_id.*' => 'required|exists:bahans,bahan_id',
            'satuan_bahan.*' => 'required|string|max:10',
            'takaran.*' => 'required|numeric|min:0.01',
        ];
    }

    public function messages()
    {
        return [
            'bahan_id.*.required' => 'Pilih bahan untuk setiap produk.',
            'bahan_id.*.exists' => 'Bahan yang dipilih tidak valid.',
            'satuan_bahan.*.required' => 'Satuan bahan harus diisi.',
            'satuan_bahan.*.string' => 'Satuan bahan harus berupa teks.',
            'takaran.*.required' => 'Takaran harus diisi.',
            'takaran.*.numeric' => 'Takaran harus berupa angka.',
            'takaran.*.min' => 'Takaran minimal adalah 0.01.',
        ];
    }
}
