<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->namespace('\App\Http\Controllers\Roles')
    ->group(function () {

        Route::prefix('roles')
            ->as('roles.')
            ->group(function () {
                Route::get('index', 'Index')->name('index');
            });

    });
