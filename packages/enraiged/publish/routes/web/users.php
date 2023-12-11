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
                Route::get('{user}', 'Show')->name('show');

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

        Route::prefix('api/users')
            ->as('users.')
            ->group(function () {
                Route::namespace('Index')
                    ->prefix('index')
                    ->as('index.')
                    ->group(function () {
                        Route::match(['GET', 'POST'], 'data', 'Data')->name('data');
                        Route::match(['GET', 'POST'], 'export', 'Export')->name('export');
                    });

                Route::match(['GET', 'POST'], 'available', 'Available')->name('available');
                Route::delete('{user?}', 'Destroy')->name('delete');
                Route::patch('{user}', 'Restore')->name('restore');
                Route::patch('{user}/update', 'Update')->name('update');
                Route::post('', 'Store')->name('store');
            });

    });

Route::middleware(['auth', 'verified', 'password.confirm', 'enraiged'])
    ->namespace('\App\Http\Controllers\Users')
    ->prefix('my')
    ->as('my.')
    ->group(function(){

        Route::get('profile', 'Show')->name('profile');
        Route::get('avatar', 'Avatars\Edit')->name('avatar');
        Route::get('details', 'Profiles\Edit')->name('details');
        Route::get('files', 'Files\Index')->name('files');
        Route::get('login', 'Login\Edit')->name('login');
        Route::get('settings', 'Settings\Edit')->name('settings');

    });
