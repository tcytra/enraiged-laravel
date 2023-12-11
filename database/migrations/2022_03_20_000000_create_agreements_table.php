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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
			$table->longText('content');
            $table->enum('status', ['A', 'D', 'P', 'R'])->index();
            $table->enum('type', ['EULA', 'TOS'])->index();
			$table->string('version', 16);
            $this->track_created($table);
            $this->track_deleted($table);
            $this->track_updated($table);
            $table->timestamp('published_at')->nullable();
            $table->bigInteger('published_by')->unsigned()->nullable();

            $table->foreign('published_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreements');
    }
};
