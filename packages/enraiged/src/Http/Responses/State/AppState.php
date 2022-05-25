<?php

namespace Enraiged\Http\Responses\State;

use Enraiged\Support\Services\MenuBuilder;
use Illuminate\Contracts\Support\Responsable;

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
            'meta' => [],
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
        $menu = config('enraiged.menu');

        return (new MenuBuilder($menu))
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
