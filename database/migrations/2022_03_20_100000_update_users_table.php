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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email_verified_at', 'name']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignBigInteger('profile_id', 'profiles')->after('id')->nullable();
            $table->foreignBigInteger('role_id', 'roles')->after('profile_id')->nullable();
            $table->string('username')->nullable()->unique()->after('email');
            $table->string('dateformat', 16)->nullable()->after('remember_token');
            $table->string('timeformat', 16)->nullable()->after('dateformat');
            $table->string('timezone', 64)->nullable()->after('timeformat');
            $table->string('theme', 32)->nullable()->after('timezone');
            $table->char('language', 2)->default(config('app.locale'))->after('theme');
            $table->timestamp('deleted_at')->nullable()->after('created_at');
            $table->timestamp('verified_at')->nullable()->after('updated_at');
            $table->foreignBigInteger('created_by', 'users')->nullable();
            $table->foreignBigInteger('deleted_by', 'users')->nullable();
            $table->foreignBigInteger('updated_by', 'users')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_hidden')->default(false);
            $table->boolean('is_protected')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_id', 'role_id', 'username', 'dateformat', 'timeformat', 'timezone', 'language',
                'deleted_at', 'verified_at', 'created_by', 'deleted_by',
                'updated_by', 'is_active', 'is_hidden', 'is_protected',
            ]);

            $table->timestamp('email_verified_at')->nullable()->after('email');
        });
    }
};
