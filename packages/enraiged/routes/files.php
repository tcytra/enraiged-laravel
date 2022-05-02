<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Files')
    ->prefix('files')
    ->as('files.')
    ->group(function(){

        Route::get('{file}', 'Download')->name('download');
        Route::delete('{file}', 'Destroy')->name('destroy');

    });
