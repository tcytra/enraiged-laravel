<?php

namespace Enraiged\Users\Services;

use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateUserProfile
{
    /** @var  User  The User model. */
    protected User $user;

    /** @var  array  The array of attributes. */
    protected $attributes;

    /**
     *  Create an instance of the CreateUserProfile service.
     *
     *  @param  array   $attributes
     *  @return void
     */
    public function __construct(array $attributes)
    {
        $this->attributes = Support\UserProfileAttributes::from($attributes)->toArray();
    }

    /**
     *  Create users,profiles records and return the associated user.
     *
     *  @return self
     */
    public function handle()
    {
        $model = auth_model();

        $this->user = new $model;

        DB::transaction(function () {
            $profile_attributes = collect($this->attributes)
                ->only((new Profile)->getFillable())
                ->toArray();

            $profile = Profile::create($profile_attributes);

            $user_fillable = (!Auth::check() && !app()->environment('production')) || (Auth::check() && Auth::user()->isAdministrator)
                ? collect($this->user->getFillable())
                    ->merge(['is_hidden', 'is_protected'])
                    ->toArray()
                : $this->user->getFillable();

            $user_attributes = collect($this->attributes)
                ->only($user_fillable)
                ->merge(['profile_id' => $profile->id])
                ->toArray();

            $this->user
                ->fill($user_attributes)
                ->save();
        });

        return $this;
    }

    /**
     *  Return the instance User model.
     *
     *  @return \Enraiged\Users\Models\User
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     *  Create and return a User from provided attributes.
     *
     *  @param  array   $attributes
     *  @return \Enraiged\Users\Models\User
     */
    public static function From($attributes)
    {
        $handler = (new self($attributes))->handle();

        return $handler->user;
    }
}
