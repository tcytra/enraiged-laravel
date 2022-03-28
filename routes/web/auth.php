<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->group(function(){
        Route::namespace('Login')
            ->group(function(){
                Route::get('login', 'Create')->name('login');
                Route::post('login', 'Store')->name('login.store');
            });

        Route::namespace('Password\Reset')
            ->group(function(){
                Route::get('forgot-password', 'Create')->name('password.request');
                Route::post('forgot-password', 'Store')->name('password.email');
            });

        Route::namespace('Password')
            ->group(function(){
                Route::get('reset-password/{token}', 'Create')->name('password.reset');
                Route::get('reset-password', fn () => inertia('auth/PasswordForgot'));
                Route::post('reset-password', 'Store')->name('password.update');
            });

        Route::namespace('Register')
            ->group(function(){
                Route::get('register', 'Create')->name('register');
                Route::post('register', 'Store')->name('register.store');
            });
    });

Route::middleware('auth')
    ->group(function(){
        Route::namespace('Password\Confirm')
            ->group(function(){
                Route::get('confirm-password', 'Create')->name('password.confirm');
                Route::post('confirm-password', 'Store')->name('password.confirm.store');
            });

        Route::namespace('Verify\Email')
            ->group(function(){
                Route::get('verify-email', 'Prompt')->name('verification.notice');
                Route::post('email/verification-notification', 'Notification')
                    ->middleware('throttle:6,1')
                    ->name('verification.send');
            });

        Route::namespace('Verify')
            ->group(function(){
                Route::get('verify-email/{id}/{hash}', 'Email')
                    ->middleware(['signed', 'throttle:6,1'])
                    ->name('verification.verify');
            });

        Route::delete('logout', 'Login\Destroy')->name('logout');
    });
