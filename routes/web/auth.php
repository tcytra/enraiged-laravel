<?php

use Illuminate\Support\Facades\Route;

Route::namespace('\App\Http\Controllers\Auth')
    ->group(function () {

        Route::middleware('guest')
            ->group(function () {

                Route::namespace('Login')
                    ->group(function () {
                        Route::get('login', 'Create')->name('login');
                        Route::post('login', 'Store');
                    });

                Route::namespace('Password\Forgot')
                    ->group(function () {
                        Route::get('forgot-password', 'Create')->name('password.request');
                        Route::post('forgot-password', 'Store')->name('password.email');
                    });

                Route::namespace('Password\Reset')
                    ->group(function () {
                        Route::get('reset-password/{token}', 'Create')->name('password.reset');
                        Route::post('reset-password', 'Store')->name('password.store');
                    });

                Route::namespace('Register')
                    ->group(function(){
                        Route::get('register', 'Create')->name('register');
                        Route::post('register', 'Store');
                    });

            });

        Route::middleware('auth')
            ->group(function () {

                Route::namespace('Password\Confirm')
                    ->group(function () {
                        Route::get('confirm-password', 'Show')->name('password.confirm');
                        Route::post('confirm-password', 'Store');
                    });

                Route::namespace('Verify\Email')
                    ->group(function () {
                        Route::get('verify-email', 'Show')->name('verification.notice');
                        Route::post('email/verification-notification', 'Store')
                            ->middleware('throttle:6,1')
                            ->name('verification.send');
                        Route::get('verify-email/{id}/{hash}', 'Update')
                            ->middleware(['signed', 'throttle:6,1'])
                            ->name('verification.verify');
                    });

                // Route::namespace('Verify\Phone')
                //     ->group(function () {
                //     });

                Route::post('logout', 'Login\Destroy')->name('logout');

            });

    });
