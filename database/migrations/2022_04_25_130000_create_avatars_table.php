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
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();
            $table->morphs('avatarable');
            $table->integer('color')->unsigned()->nullable();
            $table->trackCreated();
            $table->trackUpdated();
            $table->index(['avatarable_id', 'avatarable_type'], 'avatarable');
        });
    }

    /**
     *  Reverse the migrations.
     *
     *  @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatars');
    }
};
