<?php

namespace App\Http\Middleware;

use Enraiged\Support\Builders\AppStateBuilder;
use Enraiged\Support\Builders\FlashableBuilder;
use Illuminate\Http\Request;
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
        return [
            ...parent::share($request),
            ...$this->state($request),
        ];
    }

    /**
     *  Assemble and return the app state response.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    private function state(Request $request): array
    {
        return [
            'flash' => (new FlashableBuilder)->handle($request),
            ...(new AppStateBuilder)->handle($request)->get(),
        ];
    }
}
