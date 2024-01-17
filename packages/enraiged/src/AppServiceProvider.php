<?php

namespace Enraiged;

use Enraiged\Support\Commands\StorageClear;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
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
        $this->enraigedBlueprinting();

        // $this->enraigedPublishing();

        $this->app['router']->middlewareGroup('enraiged', [
            \Enraiged\Support\Middleware\Impersonate::class,
            \Enraiged\Support\Middleware\SetLanguage::class,
        ]);

        Relation::morphMap([
            //'avatar' => 'Enraiged\Avatars\Models\Avatar',
            //'person' => 'Enraiged\Persons\Models\Person',
            //'user' => auth_model(),
        ]);
    }

    /**
     *  Add some useful methods to the Illuminate Blueprint.
     *
     *  @return self
     */
    private function enraigedBlueprinting()
    {
        $auth_model = auth_model();
        $auth_table = (new $auth_model)->getTable();

        Blueprint::macro('foreignBigInteger', function ($local_column, $foreign_table, $foreign_id = 'id', $nullable = false) {
            $column = $this->bigInteger($local_column)->unsigned()->index();
            $this->foreign($local_column)->references($foreign_id)->on($foreign_table);

            return $nullable
                ? $column->nullable()
                : $column;
        });

        Blueprint::macro('foreignMediumInteger', function ($local_column, $foreign_table, $foreign_id = 'id', $nullable = false) {
            $column = $this->mediumInteger($local_column)->unsigned()->index();
            $this->foreign($local_column)->references($foreign_id)->on($foreign_table);

            return $nullable
                ? $column->nullable()
                : $column;
        });

        Blueprint::macro('foreignSmallInteger', function ($local_column, $foreign_table, $foreign_id = 'id', $nullable = false) {
            $column = $this->smallInteger($local_column)->unsigned()->index();
            $this->foreign($local_column)->references($foreign_id)->on($foreign_table);

            return $nullable
                ? $column->nullable()
                : $column;
        });

        Blueprint::macro('foreignTinyInteger', function ($local_column, $foreign_table, $foreign_id = 'id', $nullable = true) {
            $column = $this->tinyInteger($local_column)->unsigned()->index();
            $this->foreign($local_column)->references($foreign_id)->on($foreign_table);

            return $nullable
                ? $column->nullable()
                : $column;
        });

        Blueprint::macro('trackAll', function ($precision = 0) use ($auth_table) {
            $this->timestamp('created_at', $precision)->nullable();
            $this->timestamp('deleted_at', $precision)->nullable();
            $this->timestamp('updated_at', $precision)->nullable();

            $this->foreignbigInteger('created_by', $auth_table)->nullable();
            $this->foreignbigInteger('deleted_by', $auth_table)->nullable();
            $this->foreignbigInteger('updated_by', $auth_table)->nullable();
        });

        Blueprint::macro('trackCreated', function ($precision = 0) use ($auth_table) {
            $this->timestamp('created_at', $precision)->nullable();
            $this->foreignbigInteger('created_by', $auth_table)->nullable();
        });

        Blueprint::macro('trackDeleted', function ($precision = 0) use ($auth_table) {
            $this->timestamp('deleted_at', $precision)->nullable();
            $this->foreignbigInteger('deleted_by', $auth_table)->nullable();
        });

        Blueprint::macro('trackUpdated', function ($precision = 0) use ($auth_table) {
            $this->timestamp('updated_at', $precision)->nullable();
            $this->foreignbigInteger('updated_by', $auth_table)->nullable();
        });

        return $this;
    }

    /**
     *  Execute registration of publishable assets.
     *
     *  @return self
     *
    protected function enraigedPublishing()
    {
        $this->publishes([__DIR__.'/../publish/config' => base_path('config')], ['enraiged-config', 'enraiged']);
        $this->publishes([__DIR__.'/../publish/database/migrations' => database_path('migrations')], ['enraiged-database', 'enraiged-migrations', 'enraiged']);
        $this->publishes([__DIR__.'/../publish/database/seeders' => database_path('seeders')], ['enraiged-database', 'enraiged-seeders', 'enraiged']);
        $this->publishes([__DIR__.'/../publish/resources/seeds' => resource_path('seeds')], ['enraiged-resources', 'enraiged-seeds', 'enraiged']);
        $this->publishes([__DIR__.'/../publish/routes' => base_path('routes')], ['enraiged-routes', 'enraiged']);

        return $this;
    }*/
}
