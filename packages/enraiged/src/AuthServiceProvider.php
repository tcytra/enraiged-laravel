<?php

namespace Enraiged;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     *  The policy mappings for the application.
     *
     *  @var array
     */
    protected $policies = [
        \Enraiged\Avatars\Models\Avatar::class
            => \Enraiged\Avatars\Policies\AvatarPolicy::class,

        \Enraiged\Profiles\Models\Profile::class
            => \Enraiged\Profiles\Policies\ProfilePolicy::class,

        \Enraiged\Roles\Models\Role::class
            => \Enraiged\Roles\Policies\RolePolicy::class,

        \Enraiged\Users\Models\User::class
            => \Enraiged\Users\Policies\UserPolicy::class,
    ];

    /**
     *  Register any authentication / authorization services.
     *
     *  @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
