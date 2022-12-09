<?php

namespace Enraiged\Avatars\Policies;

use App\Auth\User;
use Enraiged\Avatars\Models\Avatar;
use Enraiged\Roles\Enums\Roles;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvatarPolicy
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
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     */
    public function delete(User $user, Avatar $avatar)
    {
        return $this->update($user, $avatar);
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     */
    public function edit(User $user, Avatar $avatar)
    {
        return $this->update($user, $avatar);
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     */
    public function show(User $user, Avatar $avatar)
    {
        return $avatar->exists;
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     *  @todo   A means of identifying the avatarable->user->id (created_by?)
     */
    public function update(User $user, Avatar $avatar)
    {
        return $this->upload($user, $avatar);
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     */
    public function upload(User $user, Avatar $avatar)
    {
        return $user->id === $avatar->avatarable->account->id;
    }
}
