<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as Middleware;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureEmailIsVerified extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user()) { // should never get here... unless the dev misconfigured the routes?
            return $request->expectsJson()
                ? abort(401, __('Unauthenticated'))
                : Redirect::guest(URL::route($redirectToRoute ?: 'login'));
        }

        if ($request->user()->mustVerifySecondary
            && $request->session()->get('secondaryEmailLogin')) {
            return $request->expectsJson()
                ? abort(403, __('Your secondary email address is unverified.'))
                : Redirect::guest(URL::route($redirectToRoute ?: 'secondary.verification.notice'));
        }

        if ($request->user()->mustVerifyEmail) {
            return $request->expectsJson()
                ? abort(403, __('Your email address is unverified.'))
                : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        }

        return $next($request);
    }
}
