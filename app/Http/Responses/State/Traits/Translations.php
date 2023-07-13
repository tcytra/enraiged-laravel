<?php

namespace App\Http\Responses\State\Traits;

use Illuminate\Http\Request;

trait Translations
{
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
