<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HandleImpersonation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->hasSession() && $request->session()->has('impersonate')) {
            $model = config('auth.providers.users.model');

            Auth::setUser(
                $model::find($request->session()->get('impersonate'))
            );
        }

        return $next($request);
    }
}
