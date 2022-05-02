<?php

namespace Enraiged\Accounts\Resources;

use Enraiged\Http\Resources\JsonResource;

class AccountLoginResource extends JsonResource
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
            'username' => $this->username,
        ];
    }
}
