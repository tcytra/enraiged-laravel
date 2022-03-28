<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Account\ProfileResource;
use App\Http\Resources\JsonResource;

class UserResource extends JsonResource
{
    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'is_active' => $this->is_active,
            'profile' => ProfileResource::from($this->whenLoaded('profile')),
        ];
    }
}
