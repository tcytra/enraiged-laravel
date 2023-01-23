<?php

namespace Enraiged\Support\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class SetLanguage
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
        $language = $request->user()->language ?? config('app.locale');

        app()->setLocale($language);
        Carbon::setLocale($language);

        return $next($request);
    }
}
