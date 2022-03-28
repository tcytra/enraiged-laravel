<?php

namespace App\Http\Controllers\Auth\Verify;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class Email extends Controller
{
    /**
     *  Create an instance of the verify email controller.
     *
     *  @return void
     *  @todo   not currently implemented, maybe never will be
    public function __construct()
    {
        if (config('auth.automated_logins') !== true) {
            $this->middleware('auth');
        }
    }*/

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME); // .'?verified=1' // is this needed?
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // not currently implemented
        // if (config('auth.automated_logins') === true) {
        //     Auth::login($request->user);
        // }

        $request->session()->put('success', 'Confirmation successful.');

        return redirect()->intended(RouteServiceProvider::HOME); // .'?verified=1' // same as above?
    }
}
