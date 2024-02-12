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

        Blueprint::macro('foreignTinyInteger', function ($local_column, $foreign_table, $foreign_id = 'id', $nullable = false) {
            $column = $this->tinyInteger($local_column)->unsigned()->index();
            $this->foreign($local_column)->references($foreign_id)->on($foreign_table);

            return $nullable
                ? $column->nullable()
                : $column;
        });

        Blueprint::macro('track', function ($name, $nullable = false, $precision = 0) use ($auth_table) {
            if (gettype($name) === 'array') {
                $columns = [];

                foreach ($name as $index => $value) {
                    $has_arguments = preg_match('/^[a-z]/', $index);

                    $column_name = $has_arguments
                        ? $index
                        : $value;

                    $set_nullable = $has_arguments
                        ? (gettype($value) === 'array' && key_exists('nullable', $value) ? $value['nullable'] : $value)
                        : $nullable;

                    $set_precision = $has_arguments && gettype($value) === 'array' && key_exists('precision', $value)
                        ? $value['precision']
                        : $precision;

                    $timestamp = $this->timestamp("{$column_name}_at", $set_precision);

                    if ($set_nullable) {
                        $timestamp->nullable();
                    }

                    $columns[$column_name] = $set_nullable;
                }

                foreach ($columns as $column_name => $set_nullable) {
                    $foreignid = $this->foreignBigInteger("{$column_name}_by", $auth_table);

                    if ($set_nullable) {
                        $foreignid->nullable();
                    }
                }

            } else {
                $timestamp = $this->timestamp("{$name}_at", $precision);
                $foreignid = $this->foreignBigInteger("{$name}_by", $auth_table);

                if ($nullable) {
                    $timestamp->nullable();
                    $foreignid->nullable();
                }
            }
        });

        Blueprint::macro('trackAll', function ($nullable = true, $precision = 0) {
            $this->track(['created', 'deleted', 'updated'], $nullable, $precision);
        });

        Blueprint::macro('trackCreated', function ($nullable = true, $precision = 0) {
            $this->track('created', $nullable, $precision);
        });

        Blueprint::macro('trackDeleted', function ($nullable = true, $precision = 0) {
            $this->track('deleted', $nullable, $precision);
        });

        Blueprint::macro('trackUpdated', function ($nullable = true, $precision = 0) {
            $this->track('updated', $nullable, $precision);
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
