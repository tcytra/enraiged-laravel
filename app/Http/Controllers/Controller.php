<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
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
