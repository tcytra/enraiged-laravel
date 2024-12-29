<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        $this->impersonate($request);

        $this->locale($request);

        return $next($request);
    }

    /**
     * Handle an impersonation requirement.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function impersonate($request)
    {
        if ($request->hasSession() && $request->session()->has('impersonate')) {
            $impersonating = auth_model()::find($request->session()->get('impersonate'));

            Auth::setUser($impersonating);
        }
    }

    /**
     * Handle an impersonation requirement.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function locale($request)
    {
        $language = $request->user()->language ?? config('app.locale');

        app()->setLocale($language);
        Carbon::setLocale($language);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
