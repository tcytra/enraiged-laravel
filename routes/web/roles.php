<?php

Route::middleware(['auth', 'verified'])
    ->namespace('\App\Http\Controllers\Roles')
    ->group(function(){

        Route::prefix('api/roles')
            ->as('roles.')
            ->group(function () {
                Route::match(['GET', 'POST'], 'available', 'Available')->name('available');
            });

    });
