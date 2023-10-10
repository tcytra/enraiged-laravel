<?php

namespace Enraiged\Users\Services;

use Enraiged\Users\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateUserProfile
{
    /** @var  object  The User model. */
    protected User $user;

    /** @var  array  The array of attributes. */
    protected $attributes;

    /**
     *  Create an instance of the UpdateUserProfile service.
     *
     *  @param  \App\Teamo\Users\Models\User  $user
     *  @param  array   $attributes
     *  @return void
     */
    public function __construct(User $user, array $attributes)
    {
        $this->user = $user;
        $this->attributes = UserProfileAttributes::from($attributes)->toArray();
    }

    /**
     *  Update the users,profiles records and return the associated user.
     *
     *  @return self
     */
    public function handle()
    {
        DB::transaction(function () {
            $user_attributes = collect($this->attributes)
                ->only($this->user->getFillable())
                ->toArray();

            $this->user->update($user_attributes);

            $profile_attributes = collect($this->attributes)
                ->only($this->user->profile->getFillable())
                ->toArray();

            $this->user->profile->update($profile_attributes);
        });

        return $this;
    }

    /**
     *  Update and return a User from provided attributes.
     *
     *  @param  \App\Teamo\Users\Models\User  $user
     *  @param  array   $attributes
     *  @return \App\Teamo\Users\Models\User
     */
    public static function From(User $user, array $attributes): User
    {
        $handler = (new self($user, $attributes))->handle();

        return $handler->user;
    }
}
