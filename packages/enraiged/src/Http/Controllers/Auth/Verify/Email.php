<?php

namespace Enraiged\Http\Controllers\Auth\Verify;

use App\Providers\RouteServiceProvider;
use Enraiged\Http\Controllers\Auth\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class Email extends Controller
{
    /**
     *  Mark the authenticated user's email address as verified.
     *
     *  @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME); // .'?verified=1' // is this needed?
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        $request->session()->put('success', 'Confirmation successful.');

        return redirect()->intended(RouteServiceProvider::HOME); // .'?verified=1' // same as above?
    }
}
