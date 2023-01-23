<?php

namespace Enraiged\Users\Services;

use Enraiged\Users\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateUserProfile
{
    use Traits\LoadParameters;

    /** @var  object  The User model. */
    protected User $user;

    /** @var  array  The provided parameters. */
    protected $parameters;

    /**
     *  Create an instance of the UpdateUserProfile service.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  array   $parameters
     *  @return void
     */
    public function __construct(User $user, array $parameters)
    {
        $this->user = $user;

        $this->load($parameters);
    }

    /**
     *  Update the users,profiles records and return the associated user.
     *
     *  @return self
     */
    public function handle()
    {
        DB::transaction(function () {
            $user_parameters = collect($this->parameters)
                ->only($this->user->getFillable())
                ->toArray();

            $this->user->update($user_parameters);

            $profile_parameters = collect($this->parameters)
                ->only($this->user->profile->getFillable())
                ->toArray();

            $this->user->profile->update($profile_parameters);
        });

        return $this;
    }

    /**
     *  Update and return a User from provided parameters.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  array   $parameters
     *  @return \Enraiged\Users\Models\User
     */
    public static function From(User $user, array $parameters)
    {
        $builder = (new self($user, $parameters))->handle();

        return $builder->user;
    }
}
