<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SetLocale
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
        $locale = config('app.locale');

        if (Auth::check() && $request->user()->locale) {
            $locale = $request->user()->locale;

        } else if ($request->has('locale')) {
            $locale = $request->get('locale');
        }

        app()->setLocale($locale);

        Carbon::setLocale($locale);

        return $next($request);
    }
}
