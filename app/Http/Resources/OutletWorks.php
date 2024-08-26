<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OutletWorks extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'outlet_id'     =>  $this->outlet_id,
            'outlet_name'   =>  $this->outlet_name,
            'slug'          =>  $this->slug,
        ];
    }
}
