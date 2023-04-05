<?php

namespace Enraiged\Profiles\Observers;

use Enraiged\Profiles\Models\Profile;

class ProfileObserver
{
    /**
     *  Handle the Profile saved event.
     *
     *  @param  \Enraiged\Profiles\Models\Profile  $profile
     *  @return void
     */
    public function saved(Profile $profile)
    {
        if ($profile->user && $profile->user->name !== $profile->name) {
            $profile->user
                ->fill(['name' => $profile->name])
                ->save();
        }
    }
}
