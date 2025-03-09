<?php

namespace App\Providers;

use App\System\Users\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class BlueprintServiceProvider extends ServiceProvider
{
    /**
     *  Bootstrap the blueprint services.
     *
     *  @return void
     */
    public function boot()
    {
        (bool) $this
            ->foreignBigInteger()
            ->foreignMediumInteger()
            ->foreignSmallInteger()
            ->foreignTinyInteger()
            ->track()
            ->trackAll()
            ->trackCreated()
            ->trackDeleted()
            ->trackUpdated();
    }

    /**
     *  @return $this
     */
    protected function foreignBigInteger(): self
    {
        Blueprint::macro('foreignBigInteger', function ($local_column, $foreign_table, $foreign_id = 'id', $nullable = false) {
            $column = $this->bigInteger($local_column)->unsigned()->index();
            $this->foreign($local_column)->references($foreign_id)->on($foreign_table);

            return $nullable
                ? $column->nullable()
                : $column;
        });

        return $this;
    }

    /**
     *  @return $this
     */
    protected function foreignMediumInteger(): self
    {
        Blueprint::macro('foreignMediumInteger', function ($local_column, $foreign_table, $foreign_id = 'id', $nullable = false) {
            $column = $this->mediumInteger($local_column)->unsigned()->index();
            $this->foreign($local_column)->references($foreign_id)->on($foreign_table);

            return $nullable
                ? $column->nullable()
                : $column;
        });

        return $this;
    }

    /**
     *  @return $this
     */
    protected function foreignSmallInteger(): self
    {
        Blueprint::macro('foreignSmallInteger', function ($local_column, $foreign_table, $foreign_id = 'id', $nullable = false) {
            $column = $this->smallInteger($local_column)->unsigned()->index();
            $this->foreign($local_column)->references($foreign_id)->on($foreign_table);

            return $nullable
                ? $column->nullable()
                : $column;
        });

        return $this;
    }

    /**
     *  @return $this
     */
    protected function foreignTinyInteger(): self
    {
        Blueprint::macro('foreignTinyInteger', function ($local_column, $foreign_table, $foreign_id = 'id', $nullable = false) {
            $column = $this->tinyInteger($local_column)->unsigned()->index();
            $this->foreign($local_column)->references($foreign_id)->on($foreign_table);

            return $nullable
                ? $column->nullable()
                : $column;
        });

        return $this;
    }

    /**
     *  @return $this
     */
    protected function track(): self
    {
        Blueprint::macro('track', function ($name, $nullable = false, $precision = 0) {
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
                    $foreignid = $this->foreignBigInteger("{$column_name}_by", 'users');

                    if ($set_nullable) {
                        $foreignid->nullable();
                    }
                }

            } else {
                $timestamp = $this->timestamp("{$name}_at", $precision);
                $foreignid = $this->foreignBigInteger("{$name}_by", 'users');

                if ($nullable) {
                    $timestamp->nullable();
                    $foreignid->nullable();
                }
            }
        });

        return $this;
    }

    /**
     *  @return $this
     */
    protected function trackAll(): self
    {
        Blueprint::macro('trackAll', function ($nullable = true, $precision = 0) {
            $this->track(['created', 'deleted', 'updated'], $nullable, $precision);
        });

        return $this;
    }

    /**
     *  @return $this
     */
    protected function trackCreated(): self
    {
        Blueprint::macro('trackCreated', function ($nullable = true, $precision = 0) {
            $this->track('created', $nullable, $precision);
        });

        return $this;
    }

    /**
     *  @return $this
     */
    protected function trackDeleted(): self
    {
        Blueprint::macro('trackDeleted', function ($nullable = true, $precision = 0) {
            $this->track('deleted', $nullable, $precision);
        });

        return $this;
    }

    /**
     *  @return $this
     */
    protected function trackUpdated(): self
    {
        Blueprint::macro('trackUpdated', function ($nullable = true, $precision = 0) {
            $this->track('updated', $nullable, $precision);
        });

        return $this;
    }
}
