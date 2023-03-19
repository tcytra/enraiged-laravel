<?php

namespace App\Http\Middleware;

use Enraiged\Support\Builders\FlashableBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     *  The root template that's loaded on the first page visit.
     *
     *  @var string
     *
     *  @see https://inertiajs.com/server-side-setup#root-template
     */
    protected $rootView = 'app';

    /**
     *  Determines the current asset version.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return string|null
     *
     *  @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     *  Defines the props that are shared by default.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     *
     *  @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        $response = [
            'auth' => Auth::check(),
            'flash' => (new FlashableBuilder)->handle($request),
            'language' => Auth::check() ? Auth::user()->language : config('app.locale'),
        ];

        return [
            ...parent::share($request),
            ...$response,
        ];
    }
}
