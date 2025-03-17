<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class SetRequestedLocale extends Middleware
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
        if ($request->has('locale')) {
            app()->setLocale($request->get('locale'));
        }

        return $next($request);
    }
}
