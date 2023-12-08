<?php

namespace Enraiged\Profiles\Policies;

use App\Enums\Roles;
use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool|void
     */
    public function before(User $user)
    {
        if ($user->role->is(Roles::Administrator)) {
            return true;
        }
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Profiles\Models\Profile  $profile
     *  @return bool
     */
    public function show(User $user, Profile $profile)
    {
        return $profile->exists;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Profiles\Models\Profile  $profile
     *  @return bool
     */
    public function update(User $user, Profile $profile)
    {
        return $user->can('update', $profile->user);
    }
}
