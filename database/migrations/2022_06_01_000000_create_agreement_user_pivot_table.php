<?php

use Enraiged\Support\Database\Migration;
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
        Schema::create('agreement_user', function (Blueprint $table) {
            $table->timestamp('agreement_at')->nullable();
            $table->bigInteger('agreement_by')->unsigned();
            $table->bigInteger('agreement_id')->unsigned();

            $table->foreign('agreement_by')->references('id')->on('users');
            $table->foreign('agreement_id')->references('id')->on('agreements');
        });
    }

    /**
     *  Reverse the migrations.
     *
     *  @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreement_user');
    }
};
