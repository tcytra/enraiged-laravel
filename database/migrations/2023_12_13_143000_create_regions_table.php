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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->foreignBigInteger('country_id', 'countries');
            $table->char('code', 2);
            $table->string('name', 32);
            $table->string('type', 16);
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     *  Reverse the migrations.
     *
     *  @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
};
