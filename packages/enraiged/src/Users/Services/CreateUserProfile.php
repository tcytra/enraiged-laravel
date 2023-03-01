<?php

namespace Enraiged\Users\Services;

use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Models\User;
use Illuminate\Support\Facades\DB;

class CreateUserProfile
{
    use Traits\LoadParameters;

    /** @var  object  The User model. */
    protected User $user;

    /** @var  array  The provided parameters. */
    protected $parameters;

    /**
     *  Create an instance of the CreateUserProfile service.
     *
     *  @param  array   $parameters
     *  @return void
     */
    public function __construct(array $parameters)
    {
        $this->load($parameters);
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
            $profile_parameters = collect($this->parameters)
                ->only((new Profile)->getFillable())
                ->toArray();

            $profile = Profile::create($profile_parameters);

            $user_parameters = collect($this->parameters)
                ->only($this->user->getFillable())
                ->merge(['profile_id' => $profile->id])
                ->toArray();

            $this->user
                ->fill($user_parameters)
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
     *  Create and return an User from provided parameters.
     *
     *  @param  array   $parameters
     *  @return \Enraiged\Users\Models\User
     */
    public static function From($parameters)
    {
        $builder = (new self($parameters))->handle();

        return $builder;
    }
}
