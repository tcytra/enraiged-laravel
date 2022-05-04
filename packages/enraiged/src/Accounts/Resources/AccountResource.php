<?php

namespace Enraiged\Accounts\Resources;

use Enraiged\Http\Resources\DatetimeAttributeResource;
use Enraiged\Http\Resources\JsonResource;

class AccountResource extends JsonResource
{
    use Traits\Actions,
        Traits\Avatar,
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
            'is_myself' => $this->is_myself,
            'timezone' => $this->timezone,
            'avatar' => $this->avatar(),
            'profile' => $this->profile(),
        ];

        if (count($this->actions) && $this->is_myself) {
            $resource['actions'] = $this->actions();
        }

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
