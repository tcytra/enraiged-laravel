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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profile_id')->unsigned()->nullable()->index();
            $table->string('email')->unique();
            $table->string('username')->nullable()->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('timezone')->nullable();
            $table->string('agreement_version', 10)->nullable();
            $table->timestamp('agreed_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_hidden')->default(false);
            $table->boolean('is_protected')->default(false);
            $table->foreign('profile_id')->references('id')->on('users');
        });

        foreach (['profiles', 'users'] as $each) {
            Schema::table($each, function (Blueprint $table) {
                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('deleted_by')->references('id')->on('users');
                $table->foreign('updated_by')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
