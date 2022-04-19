<?php

namespace Enraiged\Support\Database;

use Illuminate\Database\Migrations\Migration as IlluminateMigration;

/**
 *  @complaint  I am unable to overload Blueprint with custom table methods :(
 */
class Migration extends IlluminateMigration
{
    /**
     *  Add create timestamp and user foreign key.
     *
     *  @param  \Illuminate\Database\Schema\Blueprint  $table
     *  @param  int     $precision
     *  @return void
     */
    public function track_created($table, $precision = 0)
    {
        $table->timestamp('created_at', $precision)->nullable();
        $table->bigInteger('created_by')->unsigned()->nullable();
        $table->foreign('created_by')->references('id')->on('users');
    }

    /**
     *  Add delete timestamp and user foreign key.
     *
     *  @param  \Illuminate\Database\Schema\Blueprint  $table
     *  @param  int     $precision
     *  @return void
     */
    public function track_deleted($table, $precision = 0)
    {
        $table->timestamp('deleted_at', $precision)->nullable();
        $table->bigInteger('deleted_by')->unsigned()->nullable();
        $table->foreign('deleted_by')->references('id')->on('users');
    }

    /**
     *  Add update timestamp and user foreign key.
     *
     *  @param  \Illuminate\Database\Schema\Blueprint  $table
     *  @param  int     $precision
     *  @return void
     */
    public function track_updated($table, $precision = 0)
    {
        $table->timestamp('updated_at', $precision)->nullable();
        $table->bigInteger('updated_by')->unsigned()->nullable();
        $table->foreign('updated_by')->references('id')->on('users');
    }

    /**
     *  Add create, delete, update timestamps and user foreign keys.
     *
     *  @param  \Illuminate\Database\Schema\Blueprint  $table
     *  @param  int     $precision
     *  @return void
     */
    public function tracking($table, $precision = 0)
    {
        $table->timestamp('created_at', $precision)->nullable();
        $table->timestamp('deleted_at', $precision)->nullable();
        $table->timestamp('updated_at', $precision)->nullable();

        $table->bigInteger('created_by')->unsigned()->nullable();
        $table->bigInteger('deleted_by')->unsigned()->nullable();
        $table->bigInteger('updated_by')->unsigned()->nullable();

        $table->foreign('created_by')->references('id')->on('users');
        $table->foreign('deleted_by')->references('id')->on('users');
        $table->foreign('updated_by')->references('id')->on('users');
    }
}
