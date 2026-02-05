<?php

use Illuminate\Support\Facades\Route;

Route::namespace('\App\Http\Controllers\Geo')
    ->prefix('geo')
    ->as('geo.')
    ->group(function () {

        Route::namespace('Countries')
            ->prefix('countries')
            ->as('countries.')
            ->group(function () {
                Route::match(['get', 'post'], 'available', 'Available')->name('available');
            });

        Route::namespace('Regions')
            ->prefix('regions')
            ->as('regions.')
            ->group(function () {
                Route::match(['get', 'post'], 'available', 'Available')->name('available');
            });

        Route::namespace('Timezones')
            ->prefix('timezones')
            ->as('timezones.')
            ->group(function () {
                Route::match(['get', 'post'], 'available', 'Available')->name('available');
            });

    });
