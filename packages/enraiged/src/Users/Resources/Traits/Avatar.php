<?php

namespace Enraiged\Users\Resources\Traits;

use Enraiged\Avatars\Resources\AvatarResource;

trait Avatar
{
    /** @var  bool  Whether or not to include the avatar with this resource. */
    protected bool $with_avatar = true;

    /**
     *  @return array
     */
    protected function avatar()
    {
        $this->profile->load('avatar');

        return AvatarResource::from($this->profile->avatar);
    }

    /**
     *  Ensure the resource includes the avatar.
     *
     *  @return self
     */
    public function withAvatar()
    {
        $this->with_avatar = true;

        return $this;
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
}
