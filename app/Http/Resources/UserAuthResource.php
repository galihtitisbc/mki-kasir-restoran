<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user_id"       =>  $this->user_id,
            "name"          =>  $this->name,
            "username"      =>  $this->username,
            "email"         =>  $this->email,
            "phone"         =>  $this->phone,
            "supervisor_id" =>  $this->supervisor_id,
            "is_active"     => $this->is_active
        ];
    }
}
