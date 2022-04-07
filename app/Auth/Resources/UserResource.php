<?php

namespace App\Auth\Resources;

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
        ];
    }
}
