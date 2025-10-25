<?php

namespace App\Http\Middleware;

use Enraiged\Users\Traits\Requests\RecentFiles;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    use RecentFiles;

    /**
     *  The root template that is loaded on the first page visit.
     *
     *  @var string
     */
    protected $rootView = 'app';

    /**
     *  Determine the current asset version.
     *
     *  @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     *  Define the props that are shared by default.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $props = [
            ...parent::share($request),
            'files' => $this->recentFiles($request),
            'message' => $request->session()->get('message'),
            'status' => $request->session()->get('status'),
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];

        return $props;
    }
}
