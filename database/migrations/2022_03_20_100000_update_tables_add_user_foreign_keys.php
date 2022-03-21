<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (['persons', 'users'] as $each) {
            Schema::table($each, function (Blueprint $table) {
                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('deleted_by')->references('id')->on('users');
                $table->foreign('updated_by')->references('id')->on('users');
            });
        }

        Schema::table('user_ip_addresses', function (Blueprint $table) {
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }
};
