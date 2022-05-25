<?php

namespace Enraiged\Http\Controllers\Auth\Login;

use App\Providers\RouteServiceProvider;
use Enraiged\Http\Controllers\Auth\Controller;
use Enraiged\Http\Requests\Auth\LoginRequest;

class Store extends Controller
{
    /**
     *  Handle an incoming authentication request.
     *
     *  @param  \Enraiged\Http\Requests\Auth\LoginRequest  $request
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
