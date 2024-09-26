<?php

namespace App\Http\Responses\State;

use Illuminate\Contracts\Support\Responsable;

class AppState implements Responsable
{
    use Traits\Menu,
        Traits\Meta,
        Traits\Users;

    /**
     *  Create an HTTP response that represents the object.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return [
            'menu' => $this->menu($request),
            'meta' => $this->meta($request),
            'user' => $this->user($request),
        ];
    }
}
