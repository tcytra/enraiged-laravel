<?php

namespace Enraiged\Http\Responses\State;

use Enraiged\Support\Services\MenuBuilder;
use Enraiged\Support\Services\MetaBuilder;
use Illuminate\Contracts\Support\Responsable;
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
        ];
    }

    /**
     *  Build and return the application menu.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    private function menu($request)
    {
        $menu = Auth::check()
            ? config('enraiged.menu.auth')
            : config('enraiged.menu.guest');

        return (new MenuBuilder($menu))
            ->handle($request);
    }

    /**
     *  Build and return the application metadata.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    private function meta($request)
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
    private function translations($request)
    {
        $translations = [];

        $lang = $request->user()->language ?? config('app.locale');
        $json = base_path("lang/{$lang}.json");

        return [$lang => json_decode(file_get_contents($json), true)];
    }
}
