<?php

namespace Enraiged\Companies;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     *  Bootstrap any application services.
     *
     *  @return void
     */
    public function boot()
    {
        //$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        //$this->loadRoutesFrom(__DIR__.'/../routes/api.php');

         $this->publishes([
             packages_path('companies/database/factories') => database_path('factories'),
        ], ['companies-factory', 'companies']);

        $this->publishes([
            __DIR__.'/../database/seeders' => database_path('seeders'),
        ], ['companies-seeder', 'companies']);

        Relation::morphMap([
            //'company' => 'Enraiged\Companies\Models\Company',
        ]);
    }

    /**
     *  Register any application services.
     *
     *  @return void
     */
    public function register()
    {
        
    }
}
