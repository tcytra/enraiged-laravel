<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Auth\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class Store extends Controller
{
    /**
     *  Handle an incoming authentication request.
     *
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $request->handle();

        if (config('auth.automated_logins') === true) {
            Auth::login($request->user);
        }

        $request->session()->put('success', true ? __('auth.email.sent') : 'Registration successful');

        return redirect(RouteServiceProvider::HOME);
    }
}
