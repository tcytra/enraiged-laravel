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
        \Enraiged\Accounts\Models\Account::class
            => \Enraiged\Accounts\Policies\AccountPolicy::class,

        \Enraiged\Avatars\Models\Avatar::class
            => \Enraiged\Avatars\Policies\AvatarPolicy::class,

        \Enraiged\Profiles\Models\Profile::class
            => \Enraiged\Profiles\Policies\ProfilePolicy::class,
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
