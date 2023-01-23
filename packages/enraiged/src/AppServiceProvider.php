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
            \Enraiged\Support\Middleware\Impersonate::class,
            \Enraiged\Support\Middleware\SetLanguage::class,
        ]);

        /*
        $this->publishes([
            __DIR__.'/../config' => config_path('enraiged')
        ], ['enraiged']);

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations')
        ], ['enraiged']);

        $this->publishes([
            __DIR__.'/../database/seeders' => database_path('seeders')
        ], ['enraiged']);

        $this->publishes([
            __DIR__.'/../resources/seeds' => resource_path('seeds')
        ], ['enraiged']);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views')
        ], ['enraiged']);

        $this->publishes([
            __DIR__.'/../routes/web.php' => base_path('routes/web.php')
        ], ['enraiged']);

        $this->publishes([
            __DIR__.'/../resources/fonts' => resource_path('fonts'),
            __DIR__.'/../resources/images' => resource_path('images'),
            __DIR__.'/../resources/js' => resource_path('js'),
            __DIR__.'/../resources/sass' => resource_path('sass'),
            __DIR__.'/../resources/package.json' => base_path('package.json'),
            __DIR__.'/../resources/webpack.config.js' => base_path('webpack.config.js'),
            __DIR__.'/../resources/webpack.mix.js' => base_path('webpack.mix.js'),
            __DIR__.'/../resources/webpack.ssr.mix.js' => base_path('webpack.ssr.mix.js'),
        ], ['enraiged']);
        */
    }
}
