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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->foreignBigInteger('country_id', 'countries')->nullable();
            $table->foreignBigInteger('region_id', 'regions')->nullable();
            $table->string('city', 32)->nullable();
            $table->string('postal', 8)->nullable();
            $table->string('street', 64)->nullable();
            $table->string('suite', 16)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_default')->default(false);
            $table->trackAll();
        });
    }

    /**
     *  Reverse the migrations.
     *
     *  @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
