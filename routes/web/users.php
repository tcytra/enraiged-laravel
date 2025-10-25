<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->namespace('\App\Http\Controllers\Users')
    ->group(function () {
        Route::prefix('users')
            ->as('users.')
            ->group(function () {
                Route::get('', 'Index')->name('index');
                Route::get('create', 'Create')->name('create');
                Route::get('{user}/edit', 'Edit')->name('edit');
                Route::get('{user}', 'Show')->name('show');

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
                Route::match(['GET', 'POST'], 'data', 'Data')->name('data');
                Route::match(['GET', 'POST'], 'export', 'Export')->name('export');
                Route::delete('{user}', 'Destroy')->name('delete');
                Route::patch('{user}', 'Restore')->name('restore');
                Route::patch('{user}/update/{attribute?}', 'Update')->name('update')
                    ->where(['attribute' => '^[a-z]{2,}(_[a-z]+)?$']);
                Route::post('', 'Store')->name('store');
                Route::put('password', 'Password\Update')->name('password.update');
            });
    });

Route::middleware(['auth', 'verified', 'password.confirm'])
    ->namespace('\App\Http\Controllers\Users')
    ->prefix('my')
    ->as('my.')
    ->group(function () {
        Route::put('password', 'Password\Update')->name('password.update');

        Route::get('profile', 'Show')->name('profile.show');
        Route::get('profile/edit', 'Edit')->name('profile.edit');
        Route::patch('profile', 'Update')->name('profile.update');
        Route::delete('profile', 'Destroy')->name('profile.delete');
    });
