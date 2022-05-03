<?php

namespace Enraiged\Profiles\Policies;

use App\Auth\User;
use Enraiged\Profiles\Models\Profile;
use Enraiged\Roles\Enums\Roles;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     *  @param  \App\Auth\User  $user
     *  @return bool|void
     */
    public function before(User $user)
    {
        if ($user->role->is(Roles::Administrator)) {
            return true;
        }
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Profiles\Models\Profile  $profile
     *  @return bool
     */
    public function show(User $user, Profile $profile)
    {
        return $profile->exists;
    }
}
