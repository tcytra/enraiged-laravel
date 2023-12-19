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
                Route::delete('{user}', 'Destroy')->name('delete');
                Route::patch('{user}', 'Restore')->name('restore');
                Route::patch('{user}/update/{attribute?}', 'Update')->name('update')->where(['attribute' => '^[a-z]{2,}(_[a-z]+)?$']);
                Route::post('', 'Store')->name('store');
            });

    });

Route::middleware(['auth', 'verified', 'password.confirm', 'enraiged'])
    ->namespace('\App\Http\Controllers\Users')
    ->prefix('my')
    ->as('my.')
    ->group(function(){

        Route::get('account', 'Show')->name('account');
        Route::get('account/details', 'Edit')->name('account.details');
        Route::get('files', 'Files\Index')->name('files');

    });
