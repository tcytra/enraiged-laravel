<?php

namespace App\Packages\Profiles\Policies;

use App\Packages\Profiles\Models\Profile;
use App\Packages\Users\Models\User;

class ProfilePolicy
{
    /**
     *  @param  \App\Odyssey\Users\Models\User  $auth
     *  @param  \App\Odyssey\Profiles\Models\Profile  $profile
     *  @return bool
     */
    public function edit(User $auth, Profile $profile)
    {
        return $auth->can('edit', $profile->user);
    }

    /**
     *  @param  \App\Odyssey\Users\Models\User  $auth
     *  @param  \App\Odyssey\Profiles\Models\Profile  $profile
     *  @return bool
     */
    public function update(User $auth, Profile $profile)
    {
        return $auth->can('update', $profile->user);
    }
}
