<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "tax_id"        => $this->tax_id,
            "tax_name"      => $this->tax_name,
            "slug"          => $this->slug,
            "tax_rate"      => $this->tax_rate,
        ];
    }
}
