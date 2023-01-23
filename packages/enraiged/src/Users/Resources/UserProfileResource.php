<?php

namespace Enraiged\Users\Resources;

class UserProfileResource extends UserResource
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
            'created' => $this->datetime('created_at'),
        ];
    }
}