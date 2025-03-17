<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     *  Handle an incoming request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Closure  $next
     *  @param  string  ...$guards
     *  @return mixed
     *
     *  @see    \Illuminate\Foundation\Configuration\Middleware
     *  @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        $this->impersonate($request);

        $this->locale($request);

        return $next($request);
    }

    /**
     *  Handle an impersonation requirement.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return void
     */
    protected function impersonate($request)
    {
        if ($request->hasSession() && $request->session()->has('impersonate')) {
            $model = config('auth.providers.users.model');
            $impersonating = $model::find($request->session()->get('impersonate'));

            Auth::setUser($impersonating);
        }
    }

    /**
     *  Handle an impersonation requirement.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return void
     */
    protected function locale($request)
    {
        $locale = $request->user()->locale ?? config('app.locale');

        app()->setLocale($locale);

        Carbon::setLocale($locale);
    }

    /**
     *  Get the path the user should be redirected to when they are not authenticated.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return string|null
     *
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }*/
}
