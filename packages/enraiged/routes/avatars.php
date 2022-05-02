<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Avatars')
    ->prefix('avatars')->as('avatars.')
    ->group(function(){

        Route::get('{avatar}', 'Show')->name('show');
        Route::delete('{avatar}', 'Destroy')->name('delete');
        Route::patch('{avatar}', 'Update')->name('update');
        Route::post('{avatar}', 'Upload')->name('upload');

    });
