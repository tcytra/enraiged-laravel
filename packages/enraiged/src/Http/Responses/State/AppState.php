<?php

namespace Enraiged\Http\Responses\State;

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
            'menu' => [],
        ];
    }

    /**
     * Retrieve and return the user preferred language translations.
     *
     * @param   Request  $request
     * @return  array
     * @todo    Provide this (and other) information only once (per session?).
     */
    private function translations($request)
    {
        $translations = [];

        /*foreach (config('enraiged.languages') as $language) {
            $lang = $language['id'];
            $json = base_path("lang/{$lang}.json");
            $translations[$lang] = json_decode(file_get_contents($json), true);
        }

        return $translations;*/

        $lang = $request->user()->language ?? config('app.locale');
        $json = base_path("lang/{$lang}.json");

        return [$lang => json_decode(file_get_contents($json), true)];
    }
}
