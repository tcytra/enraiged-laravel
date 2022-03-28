<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Account')
    ->prefix('account')->as('account.')
    ->group(function(){
        Route::get('', 'Dashboard\Show')
            ->middleware('password.confirm')
            ->name('dashboard');
    });
