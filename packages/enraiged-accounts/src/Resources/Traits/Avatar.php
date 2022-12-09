<?php

namespace Enraiged\Accounts\Resources\Traits;

use Enraiged\Avatars\Resources\AvatarResource;

trait Avatar
{
    /**
     *  @return array
     */
    private function avatar()
    {
        $this->profile->load('avatar');

        return AvatarResource::from($this->profile->avatar);
    }
}
