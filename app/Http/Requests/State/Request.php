<?php

namespace App\Http\Requests\State;

use Enraiged\Builders\Menu as MenuBuilder;
use Enraiged\Users\Resources\AuthResource;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class Request extends HttpRequest
{
    /**
     *  Assemble and return the current app state.
     *
     *  @param  string|null  $only = null
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
                'agent' => $this->agent(),
                'initials' => $this->initials(),
                'layout' => config('enraiged.layout'),
                'locales' => $this->locales(),
                'name' => config('app.name'),
                'version' => $this->version(),
            ],
            'menu' => Auth::check()
                ? (new MenuBuilder(config('enraiged.menu')))->get()
                : null,
            'theme' => $this->theme(),
            'toast' => $this->toast(),
        ];

        return $only
            ? $state[$only]
            : $state;
    }

    /**
     *  Return the browser agent type.
     *
     *  @return array
     */
    protected function agent(): array
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']); // todo: use browscap.ini or variant solution?

        return [
            'mobile' => preg_match('/mobile/', $agent) !== 0,
            'tablet' => preg_match('/tablet/', $agent) !== 0,
        ];
    }

    /**
     *  Return the application initials.
     *
     *  @return string
     */
    protected function initials(): string
    {
        $initials = '';
        $parts = explode(' ', config('app.name'));

        foreach ($parts as $each) {
            $initials = $initials.substr($each, 0, 1);
        }

        return $initials;
    }

    /**
     *  Return the application locales.
     *
     *  @return array
     */
    protected function locales(): array
    {
        return collect(config('enraiged.locales'))
            ->transform(fn ($array, $key) => __($array['name'], [], $key))
            ->toArray();
    }

    /**
     *  Return the toast configuration.
     *
     *  @return array
     */
    protected function toast(): array
    {
        return [
            'group' => 'br',
            'position' => 'bottom-right',
        ];
    }

    /**
     *  Return the useable app theme.
     *
     *  @return array
     */
    protected function theme(): array
    {
        return Auth::check()
            ? json_decode(Auth::user()->theme, true)
            : config('enraiged.theme');
    }

    /**
     *  Return the application version.
     *
     *  @return array
     */
    protected function version(): array
    {
        return [
            'enraiged' => config('enraiged.version'),
            'laravel' => Application::VERSION,
            'php' => PHP_VERSION,
        ];
    }
}
