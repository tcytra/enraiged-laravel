<?php

namespace Enraiged\Avatars\Policies;

use App\Enums\Roles;
use Enraiged\Avatars\Models\Avatar;
use Enraiged\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvatarPolicy
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
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     */
    public function delete(User $user, Avatar $avatar)
    {
        return $this->update($user, $avatar);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     */
    public function edit(User $user, Avatar $avatar)
    {
        return $this->update($user, $avatar);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     */
    public function show(User $user, Avatar $avatar)
    {
        return $avatar->exists;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     *  @todo   A means of identifying the avatarable->user->id (created_by?)
     */
    public function update(User $user, Avatar $avatar)
    {
        return $this->upload($user, $avatar);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return bool
     */
    public function upload(User $user, Avatar $avatar)
    {
        return $user->can('update', $avatar->avatarable);
    }
}
