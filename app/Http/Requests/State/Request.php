<?php

namespace App\Http\Requests\State;

use Enraiged\Users\Resources\AuthResource;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class Request extends HttpRequest
{
    /**
     *  Assemble and return the current app state.
     *
     *  @param  string  $only
     *  @return array
     */
    public function state($only = null): array
    {
        //sleep(1); // for testing
        $state = [
            'auth' => Auth::check()
                ? new AuthResource(Auth::user())
                : false,
            'meta' => [
                'locales' => collect(config('enraiged.locales'))
                    ->transform(fn ($array, $key) => __($array['name'], [], $key))
                    ->toArray(),
                'toast' => [
                    'group' => 'br',
                    'position' => 'bottom-right',
                ],
            ],
            'menu' => [
            ],
        ];

        return $only
            ? $state[$only]
            : $state;
    }
}
