<?php

use Enraiged\Support\Database\Migration;
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
            $table->bigInteger('avatarable_id')->unsigned();
            $table->string('avatarable_type');
            $table->integer('color')->unsigned()->nullable();

            $this->track_created($table);
            $this->track_updated($table);
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
