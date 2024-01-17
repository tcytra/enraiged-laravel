<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *  Run the migrations.
     *
     *  @return void
     */
    public function up()
    {
        Schema::create('notification_options', function (Blueprint $table) {
            $table->id();
            $table->foreignBigInteger('user_id', 'users');
            $table->string('name');
            $table->boolean('mail')->default(false);
            $table->boolean('push')->default(false);
            $table->boolean('sms')->default(false);
        });
    }

    /**
     *  Reverse the migrations.
     *
     *  @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_options');
    }
};
