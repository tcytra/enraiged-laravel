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

                Route::namespace('Impersonate')
                    ->prefix('impersonate')
                    ->group(function () {
                        Route::get('stop', 'Stop')->name('impersonate.stop');
                        Route::get('{account}', 'Start')->name('impersonate');
                    });
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

    });
