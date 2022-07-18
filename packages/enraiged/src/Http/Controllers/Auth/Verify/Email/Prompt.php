<?php

namespace Enraiged\Http\Controllers\Auth\Verify\Email;

use App\Providers\RouteServiceProvider;
use Enraiged\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Prompt extends Controller
{
    /**
     *  Display the email verification prompt.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : inertia('auth/VerifyEmail');
    }
}
