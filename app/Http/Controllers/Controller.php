<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
