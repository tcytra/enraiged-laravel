<?php

namespace Enraiged\Accounts\Resources;

use App\Http\Resources\JsonResource;
use Enraiged\Support\Resources\DatetimeAttributeResource;

class AccountResource extends JsonResource
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
        $resource = [
            'id' => $this->id,
            'email' => $this->email,
            'username' => $this->username,
            'is_active' => $this->is_active,
            'timezone' => $this->timezone,
            'avatar' => $this->avatar(),
            'profile' => $this->profile(),
        ];

        if ($this->created) {
            $resource['created'] = DatetimeAttributeResource::from($this)
                ->attribute('created_at');
        }

        if ($this->updated) {
            $resource['updated'] = DatetimeAttributeResource::from($this)
                ->attribute('updated_at');
        }

        return $resource;
    }
}
