<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Auth\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

class Store extends Controller
{
    /**
     *  Handle an incoming authentication request.
     *
     *  @param  \App\Http\Requests\Auth\LoginRequest  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $request->session()->put('success', 'Login Successful.');

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
