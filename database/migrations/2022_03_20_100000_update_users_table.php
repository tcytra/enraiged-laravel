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
            $table->foreignBigInteger('profile_id', 'profiles')->nullable()->after('id');
            // $table->foreignBigInteger('role_id', 'roles')->nullable()->after('profile_id');
            $table->tinyInteger('role_id')->after('profile_id');

            $table->boolean('is_active')->default(true)->after('role_id');
            $table->boolean('is_hidden')->default(false)->after('is_active');
            $table->boolean('is_protected')->default(false)->after('is_hidden');

            $table->char('locale', 2)->default(config('app.locale'))->after('is_protected');
            $table->string('username')->nullable()->unique()->after('password');
            $table->string('theme')->nullable()->after('username');
            $table->string('timezone', 100)->nullable()->after('theme');

            $table->timestamp('email_verified_at')->nullable()->after('remember_token')->change();
            $table->timestamp('phone_verified_at')->nullable()->after('email_verified_at');
            $table->timestamp('secondary_verified_at')->nullable()->after('phone_verified_at');
            $table->timestamp('deleted_at')->nullable()->after('created_at');

            $table->foreignBigInteger('created_by', 'users')->nullable()->after('updated_at');
            $table->foreignBigInteger('deleted_by', 'users')->nullable()->after('created_by');
            $table->foreignBigInteger('updated_by', 'users')->nullable()->after('deleted_by');
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
                'profile_id', 'role_id', 'username', 'timezone', 'locale', 'theme',
                'deleted_at', 'phone_verified_at', 'secondary_verified_at',
                'created_by', 'deleted_by', 'updated_by',
                'is_active', 'is_hidden', 'is_protected',
            ]);

            $table->timestamp('email_verified_at')->nullable()->after('email');
        });
    }
};
