<?php

namespace Enraiged\Accounts\Resources;

use Enraiged\Http\Resources\Attributes\DatetimeAttributeResource as Datetime;

class AccountProfileResource extends AccountResource
{
    use Traits\Avatar,
        Traits\Profile;

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
            'avatar' => $this->avatar(),
            'profile' => $this->profile(),
            'created' => Datetime::from($this)->attribute('created_at'),
        ];
    }
}
