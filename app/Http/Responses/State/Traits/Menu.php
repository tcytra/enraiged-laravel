<?php

namespace App\Http\Responses\State\Traits;

use Enraiged\Support\Builders\MenuBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait Menu
{
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
}
