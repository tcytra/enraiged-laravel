<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->namespace('\App\Http\Controllers\Users')
    ->group(function () {
        Route::prefix('users')
            ->as('users.')
            ->group(function () {
                Route::put('{user}/password', 'Password\Update')->name('password.update');

                // Route::get('{user}/profile', 'Show')->name('profile');
                Route::get('{user}/edit', 'Edit')->name('edit');
                Route::patch('{user}', 'Update')->name('update');
                Route::delete('{user}', 'Destroy')->name('destroy');
            });
    });

Route::middleware(['auth', 'verified', 'password.confirm'])
    ->namespace('\App\Http\Controllers\Users')
    ->prefix('my')
    ->as('my.')
    ->group(function () {
        Route::put('password', 'Password\Update')->name('password.update');

        // Route::get('profile', 'Show')->name('profile');
        Route::get('profile/edit', 'Edit')->name('profile.edit');
        Route::patch('profile', 'Update')->name('profile.update');
        Route::delete('profile', 'Destroy')->name('profile.destroy');
    });
