<?php

use Illuminate\Support\Facades\Route;

Route::namespace('\Enraiged\Http\Controllers\Accounts')
    ->group(function(){

        Route::prefix('accounts')
            ->as('accounts.')
            ->group(function () {
                Route::get('', 'Index')->name('index');
                Route::get('create', 'Create')->name('create');
                Route::get('{account}', 'Show')->name('show');
                Route::get('{account}/edit', 'Edit')->name('edit');
                Route::patch('{account}/update', 'Update')->name('update');
                Route::post('', 'Store')->name('store');

                Route::get('{account}/avatar/edit', 'Avatars\Edit')->name('avatar.edit');

                Route::get('{account}/login/edit', 'Login\Edit')->name('login.edit');
                Route::patch('{account}/login/update', 'Login\Update')->name('login.update');

                Route::get('{account}/profile', 'Profiles\Show')->name('profile.show');
                Route::get('{account}/profile/edit', 'Profiles\Edit')->name('profile.edit');
                Route::patch('{account}/profile/update', 'Profiles\Update')->name('profile.update');

                Route::get('{account}/settings/edit', 'Settings\Edit')->name('settings.edit');
                Route::patch('{account}/settings/update', 'Settings\Update')->name('settings.update');

                /* Route::prefix('profiles')->as('profiles.')->group(function () {
                    //  not quite yet
                }); */
            });

        Route::prefix('api/accounts')
            ->as('accounts.')
            ->group(function () {
                Route::namespace('Index')
                    ->prefix('index')
                    ->as('index.')
                    ->group(function () {
                        Route::match(['GET', 'POST'], 'data', 'Data')->name('data');
                        Route::match(['GET', 'POST'], 'export', 'Export')->name('export');
                    });
                Route::delete('{account}', 'Destroy')->name('delete');
            });

        Route::middleware('password.confirm')
            ->prefix('my')->as('my.')
            ->group(function () {
                Route::get('account', 'Show')->name('account');
                Route::get('account/edit', 'Edit')->name('account.edit'); // full form for admins only..?

                Route::get('account/avatar', 'Avatars\Edit')->name('avatar');
                Route::get('account/login', 'Login\Edit')->name('login');
                Route::get('account/profile', 'Profiles\Edit')->name('profile');
                Route::get('account/settings', 'Settings\Edit')->name('settings');

                Route::namespace('Files')
                    ->prefix('files')
                    ->as('files.')
                    ->group(function () {
                        Route::get('', 'Index')->name('index');
                    });

            });

    });
