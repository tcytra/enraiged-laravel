<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     *  Return the generated URL to a named route.
     *
     *  @param  array|string  $name
     *  @param  mixed  $parameters
     *  @return string
     */
    public function route($name, $parameters = [])
    {
        return route($name, $parameters, config('enraiged.app.absolute_uris'));
    }
}
