<?php

namespace Enraiged\Accounts\Resources;

use App\Http\Resources\JsonResource;
use Enraiged\Profiles\Resources\ProfileResource;

class AccountResource extends JsonResource
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
            'is_active' => $this->is_active,
            'timezone' => $this->timezone,
            'profile' => ProfileResource::from($this->whenLoaded('profile')),
        ];
    }
}
