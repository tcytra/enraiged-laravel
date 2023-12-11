<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'enraiged'])
    ->namespace('\App\Http\Controllers\Avatars')
    ->prefix('api/avatars')
    ->as('avatars.')
    ->group(function(){

        Route::get('{avatar}', 'Show')->name('show');
        Route::delete('{avatar}', 'Destroy')->name('delete');
        Route::patch('{avatar}', 'Update')->name('update');
        Route::post('{avatar}', 'Upload')->name('upload');

    });
