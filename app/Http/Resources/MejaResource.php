<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MejaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meja_id'       => $this->meja_id,
            'nomor_meja'    => $this->nomor_meja,
            'status_meja'   => $this->status_meja
        ];
    }
}
