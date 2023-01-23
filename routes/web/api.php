<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')
    ->group(function () {

        Route::namespace('\App\Http\Controllers\State')
            ->group(function () {
                Route::get('app/state', 'AppState')->middleware(['auth', 'enraiged', 'verified'])->name('app.state');
                Route::get('guest/state', 'GuestState')->name('guest.state');
            });

        Route::namespace('\App\Http\Controllers\Users')
            ->prefix('users')
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
            });

    });
