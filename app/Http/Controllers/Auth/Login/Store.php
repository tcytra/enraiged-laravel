<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

class Store extends Controller
{
    /**
     *  @param  \App\Http\Requests\Auth\LoginRequest  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $request->session()->flash('success', 'Login Successful.');

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
