<?php

namespace Enraiged\Users\Resources\Traits;

use Enraiged\Profiles\Resources\ProfileResource;

trait Profile
{
    /** @var  bool  Whether or not to include the profile with this resource. */
    protected bool $with_profile = true;

    /**
     *  @return array
     */
    protected function profile()
    {
        return ProfileResource::from($this->profile);
    }

    /**
     *  Ensure the resource includes the profile.
     *
     *  @return self
     */
    public function withProfile()
    {
        $this->with_profile = true;

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
