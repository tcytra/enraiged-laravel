<?php

namespace Enraiged;

use Enraiged\Support\Commands\StorageClear;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     *  Register any application services.
     *
     *  @return void
     */
    public function register()
    {
        $this->commands([
            StorageClear::class,
        ]);
    }

    /**
     *  Bootstrap any application services.
     *
     *  @return void
     */
    public function boot()
    {
        $this->app['router']->middlewareGroup('enraiged', [
            \Enraiged\Support\Middleware\Impersonate::class,
            \Enraiged\Support\Middleware\SetLanguage::class,
        ]);

        Relation::morphMap([
            //'avatar' => 'Enraiged\Avatars\Models\Avatar',
            //'person' => 'Enraiged\Persons\Models\Person',
            'user' => auth_model(),
        ]);
    }
}
