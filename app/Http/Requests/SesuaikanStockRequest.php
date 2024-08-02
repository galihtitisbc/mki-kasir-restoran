<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SesuaikanStockRequest extends FormRequest
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
            'bahan_id' => 'required|array',
            'bahan_id.*' => 'required|exists:bahans,bahan_id',
            'stock_masuk' => 'nullable|array',
            'stock_masuk.*' => 'nullable|numeric|min:0',
            'stock_keluar' => 'nullable|array',
            'stock_keluar.*' => 'nullable|numeric|min:0',
            'shift' => 'required|in:SIANG,MALAM',
        ];
    }
}
