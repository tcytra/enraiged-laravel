<?php

namespace App\Packages\Users\Models;

use App\Packages\Users\Factories\UserFactory;
use Enraiged\Avatars\Models\Avatar;
use Enraiged\Forms\Contracts\ProvidesForm;
use Enraiged\Users\Models\User as Authenticatable;

#[Fillable([
    'email',
    'is_active',
    'is_hidden',
    'is_protected',
    'locale',
    'name',
    'password',
    'profile_id',
    'role_id',
    'theme',
    'timezone',
    'username'
])]
#[Hidden([
    'is_hidden',
    'is_protected',
    'password',
    'remember_token'
])]
class User extends Authenticatable implements ProvidesForm
{
    use Relations\BelongsToProfile,
        Traits\ProvidesForms;

    /**
     *  Return the profile avatar directly from the user model.
     *
     *  @return \Enraiged\Avatars\Models\Avatar
     */
    public function getAvatarAttribute(): Avatar
    {
        return $this->profile->avatar;
    }

    /**
     *  Create a new factory instance for the model.
     *
     *  @return \Illuminate\Database\Eloquent\Factories\Factory
     *  @static
     */
    protected static function newFactory()
    {
        return new UserFactory;
    }
}
