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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attachable_id')->unsigned();
            $table->string('attachable_type');
            $table->string('mime');
            $table->string('name');
            $table->string('path');
            $table->string('size');
            $table->trackCreated();
            $table->trackUpdated();
        });
    }

    /**
     *  Reverse the migrations.
     *
     *  @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
