<?php

namespace App\Packages\Users\Providers;

use App\Packages\Profiles\Models\Profile;
use App\Packages\Profiles\Policies\ProfilePolicy;
use App\Packages\Users\Models\User;
use App\Packages\Users\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     *  The model to policy mappings for the application.
     *
     *  @var array<class-string, class-string>
     */
    protected $policies = [
        Profile::class => ProfilePolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     *  Register any authentication / authorization services.
     *
     *  @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Relation::morphMap([
            'profile' => Profile::class,
            'user' => User::class,
        ]);
    }
}
