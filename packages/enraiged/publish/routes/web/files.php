<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'enraiged'])
    ->namespace('\App\Http\Controllers\Files')
    ->prefix('files')
    ->as('files.')
    ->group(function(){

        Route::get('{file}', 'Download')->name('download');
        Route::delete('{file}', 'Destroy')->name('destroy');

    });
