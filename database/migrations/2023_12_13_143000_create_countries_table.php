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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->char('code', 2)->unique();
            $table->char('currency', 3);
            $table->string('capital', 32);
            $table->string('citizenship', 32);
            $table->string('long', 64);
            $table->string('name', 32);
            $table->string('flag', 8);
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
        Schema::dropIfExists('countries');
    }
};
