<?php

namespace Enraiged\Users\Resources;

use App\Http\Resources\JsonResource;
use Enraiged\Support\Resources\DatetimeAttributeResource as Datetime;

class UserResource extends JsonResource
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
            'avatar' => $this->avatar(),
            'profile' => $this->profile(),
            'email' => $this->email,
            'username' => $this->username,
            'is_active' => $this->is_active,
            'is_myself' => $this->is_myself,
            'language' => $this->language,
            'timezone' => $this->timezone,
            'created' => Datetime::from($this)->attribute('created_at'),
        ];

        if ($request->session()->has('impersonate')) {
            $resource['is_impersonating'] = true;
        }

        if ($this->deleted_at) {
            $resource['deleted'] = Datetime::from($this)->attribute('deleted_at');
        }

        if ($this->created_at !== $this->updated_at) {
            $resource['updated'] = Datetime::from($this)->attribute('updated_at');
        }

        return $resource;
    }
}
