<?php

namespace Enraiged\Accounts\Resources\Traits;

use Enraiged\Profiles\Resources\ProfileResource;

trait Profile
{
    /**
     *  @return array
     */
    private function profile()
    {
        return ProfileResource::from($this->profile);
    }
}
