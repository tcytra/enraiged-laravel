<?php

namespace Enraiged\Users\Services;

use Enraiged\Users\Models\User;
use Illuminate\Support\Facades\DB;

class CreateUserProfile
{
    use Traits\HandlesAddress,
        Traits\HandlesProfile,
        Traits\HandlesUser;

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
        $this->attributes = Support\UserProfileAttributes::creating($attributes)
            ->toArray();
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

        DB::transaction(fn ()
            => $this
                ->handleUser()
                ->handleProfile()
                ->handleAddress());

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
