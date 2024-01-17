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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
			$table->longText('content');
            $table->enum('status', ['A', 'D', 'P', 'R'])->index();
            $table->enum('type', ['EULA', 'TOS'])->index();
			$table->string('version', 16);
            $table->trackAll();
            $table->timestamp('published_at')->nullable();
            $table->foreignBigInteger('published_by', 'users')->nullable();
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
