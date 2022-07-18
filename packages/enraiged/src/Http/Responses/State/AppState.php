<?php

namespace Enraiged\Http\Responses\State;

use Enraiged\Auth\Services\AuthResources;
use Enraiged\Support\Services\MenuBuilder;
use Enraiged\Support\Services\MetaBuilder;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppState implements Responsable
{
    /**
     *  Create an HTTP response that represents the object.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return [
            'auth' => $this->auth($request),
            'i18n' => $this->translations($request),
            'menu' => $this->menu($request),
            'meta' => $this->meta($request),
        ];
    }

    /**
     *  Build and return the application auth structure.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Symfony\Component\HttpFoundation\Response
     */
    public function auth(Request $request)
    {
        return (new AuthResources)->handle($request);
    }

    /**
     *  Build and return the application menu.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    private function menu(Request $request)
    {
        $config = config('enraiged.menu');

        if (key_exists('auth', $config) || key_exists('guest', $config)) {
            $menu = Auth::check()
                ? ( key_exists('auth', $config) ? $config['auth'] : [] )
                : ( key_exists('guest', $config) ? $config['guest'] : [] );
        } else {
            $menu = $config;
        }

        return (new MenuBuilder($menu))
            ->handle($request);
    }

    /**
     *  Build and return the application metadata.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    private function meta(Request $request)
    {
        return (new MetaBuilder())
            ->handle($request);
    }

    /**
     *  Retrieve and return the user preferred language translations.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    private function translations(Request $request)
    {
        $lang = $request->user()->language ?? config('app.locale');
        $json = base_path("lang/{$lang}.json");

        return [$lang => json_decode(file_get_contents($json), true)];
    }
}
