<?php

namespace App\Http\Middleware;

use Enraiged\Auth\Services\FlashMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $response = [
            'auth' => Auth::check(),
            'flash' => (new FlashMessages)->handle($request),
            'language' => Auth::check() ? Auth::user()->language : config('app.locale'),
        ];

        /*if ($request->session()->has('impersonate')) {
            $response['impersonating'] = true;
        }*/

        return array_merge(
            parent::share($request), $response
        );
    }
}
