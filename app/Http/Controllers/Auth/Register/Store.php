<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Auth\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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

        if ($request->user instanceof MustVerifyEmail) {
            $request->session()->put('success', 'Email sent');

            return redirect()
                ->back()
                ->with(['status' => 201]);
        }

        $request->session()->put('success', 'Registration successful');

        if (config('auth.automated_logins') === true) {
            Auth::login($request->user);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
