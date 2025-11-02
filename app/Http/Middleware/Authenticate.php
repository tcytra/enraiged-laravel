<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

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
     *  @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     *  Handle an unauthenticated user.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array  $guards
     *  @return never
     *
     *  @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        $request->session()
            ->flash('status', 205);

        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $request->expectsJson() ? null : $this->redirectTo($request),
        );
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
