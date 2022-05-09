<?php

namespace Enraiged;

use Enraiged\Support\Commands\StorageClear;
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
            \Enraiged\Http\Middleware\SetLanguage::class,
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //$this->loadRoutesFrom(__DIR__.'/../routes/web.php'); // todo: this is not working
    }
}
