<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->namespace('\App\Http\Controllers\Permissions')
    ->group(function () {

        Route::prefix('permissions')
            ->as('permissions.')
            ->group(function () {
                Route::get('index', 'Index')->name('index');
            });

    });
