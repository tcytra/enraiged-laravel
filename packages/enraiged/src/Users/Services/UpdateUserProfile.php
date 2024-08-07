<?php

namespace Enraiged\Users\Services;

use Enraiged\Addresses\Models\Address;
use Enraiged\Users\Models\User;
use Illuminate\Support\Facades\Auth;
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
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  array   $attributes
     *  @return void
     */
    public function __construct(User $user, array $attributes)
    {
        $this->user = $user;
        $this->attributes = Support\UserProfileAttributes::from($attributes)->toArray();
    }

    /**
     *  Update the users,profiles records and return the associated user.
     *
     *  @return self
     */
    public function handle()
    {
        DB::transaction(function () {
            $user_fillable = (!Auth::check() && !app()->environment('production')) || (Auth::check() && Auth::user()->isAdministrator)
                ? collect($this->user->getFillable())
                    ->merge(['is_hidden', 'is_protected'])
                    ->toArray()
                : $this->user->getFillable();

            $user_attributes = collect($this->attributes)
                ->only($user_fillable)
                ->toArray();

            if (count($user_attributes)) {
                $this->user
                    ->update($user_attributes);
            }

            $profile_attributes = collect($this->attributes)
                ->only($this->user->profile->getFillable())
                ->toArray();

            if (count($profile_attributes)) {
                $this->user->profile
                    ->update($profile_attributes);
            }

            $address_attributes = collect($this->attributes)
                ->only((new Address)->getFillable())
                ->toArray();

            if (count($address_attributes)) {
                if ($this->user->profile->address) {
                    $this->user->profile->address->update($address_attributes);
                } else {
                    $this->user->profile->address->create($address_attributes);
                }
            }
        });

        return $this;
    }

    /**
     *  Update and return a User from provided attributes.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  array   $attributes
     *  @return \Enraiged\Users\Models\User
     */
    public static function From(User $user, array $attributes): User
    {
        $handler = (new self($user, $attributes))->handle();

        return $handler->user;
    }
}
