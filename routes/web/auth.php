<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Login')
    ->group(function() {
        Route::middleware('guest')
            ->group(function(){
                Route::get('login', 'Create')->name('login');
                Route::post('login', 'Store')->name('login.store');
            });

        Route::delete('logout', 'Destroy')->name('logout');
    });

Route::namespace('Register')
    ->middleware('guest')
    ->group(function(){
        Route::get('register', 'Create')->name('register');
        Route::post('register', 'Store')->name('register.store');
    });
