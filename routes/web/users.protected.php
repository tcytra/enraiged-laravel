<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'password.confirm', 'enraiged'])
    ->namespace('\App\Http\Controllers\Users')
    ->prefix('my')
    ->as('my.')
    ->group(function(){

        Route::get('profile', 'Show')->name('profile');
        Route::get('avatar', 'Avatars\Edit')->name('avatar');
        Route::get('details', 'Profiles\Edit')->name('profile');
        Route::get('login', 'Login\Edit')->name('login');
        Route::get('settings', 'Settings\Edit')->name('settings');

        Route::namespace('Files')
            ->prefix('files')
            ->as('files.')
            ->group(function () {
                Route::get('', 'Index')->name('index');
            });

    });
