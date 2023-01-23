<?php

namespace App\Http\Responses\State;

use Enraiged\Support\Builders\MenuBuilder;
use Enraiged\Support\Builders\MetaBuilder;
use Enraiged\Users\Resources\UserResource;
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
            'i18n' => $this->translations($request),
            'menu' => $this->menu($request),
            'meta' => $this->meta($request),
            'user' => $this->user($request),
        ];
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

    /**
     *  Build and return the application auth structure.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function user(Request $request)
    {
        if (Auth::check()) {
            $user = $request->user();
            $user->load('profile');

            return UserResource::from($user);
        }

        return null;
    }
}
