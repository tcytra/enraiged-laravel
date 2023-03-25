<?php

namespace Enraiged\Users\Resources;

use App\Http\Resources\JsonResource;
use Enraiged\Support\Resources\DatetimeAttributeResource as Datetime;

class UserResource extends JsonResource
{
    use Traits\Avatar,
        Traits\Profile;

    /** @var  bool  Whether or not to include the avatar in the resource. */
    protected $with_avatar = true;

    /** @var  bool  Whether or not to include the avatar in the resource. */
    protected $with_profile = true;

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

        if ($this->with_avatar) {
            $resource['avatar'] = $this->avatar();
        }

        if ($this->with_profile) {
            $resource['profile'] = $this->profile();
        }

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

    /**
     *  Prevent the resource from including the avatar.
     *
     *  @return self
     */
    public function withoutAvatar()
    {
        $this->with_avatar = false;

        return $this;
    }

    /**
     *  Prevent the resource from including the profile.
     *
     *  @return self
     */
    public function withoutProfile()
    {
        $this->with_profile = false;

        return $this;
    }
}
