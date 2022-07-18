<?php

use Illuminate\Support\Facades\Route;

Route::namespace('\Enraiged\Http\Controllers\Accounts')
    ->group(function(){

        Route::prefix('my')->as('my.')
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
