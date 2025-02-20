<?php

namespace Enraiged\Support\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Impersonate
{
    /**
     *  Handle an incoming request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *  @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasSession() && $request->session()->has('impersonate')) {
            Auth::setUser(
                auth_model()::find($request->session()->get('impersonate'))
            );
        }

        return $next($request);
    }
}
