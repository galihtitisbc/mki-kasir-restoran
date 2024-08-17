<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_code'   =>    $this->product_code,
            'product_name'   =>    $this->product_name,
            'slug'           =>    $this->slug,
            'price'          =>    $this->price,
            'stock'          =>    $this->stock,
            'gambar'         =>    $this->gambar,
            'barcode'        => $this->barcode
        ];
    }
}
