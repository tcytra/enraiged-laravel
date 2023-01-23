<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'enraiged'])
    ->namespace('\App\Http\Controllers\Users')
    ->group(function(){

        Route::prefix('users')
            ->as('users.')
            ->group(function () {
                Route::get('', 'Index')->name('index');
                Route::get('create', 'Create')->name('create');
                Route::get('{user}/edit', 'Edit')->name('edit');
                Route::patch('{user}/update', 'Update')->name('update');
                Route::get('{user}', 'Show')->name('show');
                Route::post('', 'Store')->name('store');

                //  User Avatar
                Route::get('{user}/avatar/edit', 'Avatars\Edit')->name('avatar.edit');

                //  User Login
                Route::get('{user}/login/edit', 'Login\Edit')->name('login.edit');
                Route::patch('{user}/login/update', 'Login\Update')->name('login.update');

                //  User Profile
                Route::get('{user}/profile', 'Profiles\Show')->name('profile.show');
                Route::get('{user}/profile/edit', 'Profiles\Edit')->name('profile.edit');
                Route::patch('{user}/profile/update', 'Profiles\Update')->name('profile.update');

                //  User Settings
                Route::get('{user}/settings/edit', 'Settings\Edit')->name('settings.edit');
                Route::patch('{user}/settings/update', 'Settings\Update')->name('settings.update');

                //  Impersonate User
                Route::namespace('Impersonate')
                    ->prefix('impersonate')
                    ->group(function () {
                        Route::get('stop', 'Stop')->name('impersonate.stop');
                        Route::get('{user}', 'Start')->name('impersonate');
                    });
            });

    });
