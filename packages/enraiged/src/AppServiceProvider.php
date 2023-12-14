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
        // $this->publishable();

        $this->app['router']->middlewareGroup('enraiged', [
            \Enraiged\Support\Middleware\Impersonate::class,
            \Enraiged\Support\Middleware\SetLanguage::class,
        ]);

        Relation::morphMap([
            //'avatar' => 'Enraiged\Avatars\Models\Avatar',
            //'profile' => 'Enraiged\Profiles\Models\Profile',
            //'user' => auth_model(),
        ]);
    }

    /**
     *  Execute registration of publishable assets.
     *
     *  @return self
     */
    protected function publishable()
    {
        $this->publishes([__DIR__.'/../publish/config' => base_path('config')], ['enraiged-config', 'enraiged']);
        $this->publishes([__DIR__.'/../publish/database/migrations' => database_path('migrations')], ['enraiged-database', 'enraiged-migrations', 'enraiged']);
        $this->publishes([__DIR__.'/../publish/database/seeders' => database_path('seeders')], ['enraiged-database', 'enraiged-seeders', 'enraiged']);
        $this->publishes([__DIR__.'/../publish/resources/seeds' => resource_path('seeds')], ['enraiged-resources', 'enraiged-seeds', 'enraiged']);
        $this->publishes([__DIR__.'/../publish/routes' => base_path('routes')], ['enraiged-routes', 'enraiged']);

        return $this;
    }
}
