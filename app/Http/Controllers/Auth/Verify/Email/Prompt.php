<?php

namespace App\Http\Controllers\Auth\Verify\Email;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
            : intertia('auth/VerifyEmail');
    }
}
