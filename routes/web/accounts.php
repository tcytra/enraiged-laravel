<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Accounts')
    ->group(function(){

        Route::prefix('accounts')
            ->as('accounts.')
            ->group(function () {
                Route::get('', 'Index')->name('index');
                Route::get('create', 'Create')->name('create');
                Route::get('{account}', 'Show')->name('show');
                Route::get('{account}/edit', 'Edit')->name('edit');
                Route::patch('{account}/update', 'Update')->name('update');
                Route::post('', 'Store')->name('store');
            });

        Route::prefix('api/accounts')
            ->as('accounts.')
            ->group(function () {
                Route::namespace('Index')
                    ->prefix('index')
                    ->as('index.')
                    ->group(function () {
                        Route::match(['GET', 'POST'], 'data', 'Data')->name('data');
                        Route::match(['GET', 'POST'], 'export', 'Export')->name('export');
                    });
                Route::delete('{account}', 'Destroy')->name('delete');
            });

        Route::prefix('my')->as('my.')
            ->group(function () {
                Route::get('account', 'Show')->name('account');
                Route::get('account/edit', 'Edit')->middleware('password.confirm')->name('account.edit');

                Route::namespace('Files')
                    ->prefix('files')
                    ->as('files.')
                    ->group(function () {
                        Route::get('', 'Index')->name('index');
                    });
            });

    });
