<?php

namespace Enraiged\Support\Collections;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class RequestCollection extends Collection
{
    use Traits\Filled;

    /**
     *  Return the RouteCollection.
     *
     *  @return \Enraiged\Support\Collections\RouteCollection
     */
    public function route(): RouteCollection
    {
        return $this->get('route');
    }

    /**
     *  Get the user making the request.
     *
     *  @param  string|null  $guard
     *  @return mixed
     */
    public function user($guard = null)
    {
        return Auth::guard($guard)->user();
    }

    /**
     *  Create a collection from the provided Request object.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return self
     */
    public static function From(Request $request): self
    {
        $called = get_called_class();

        $parameters = [
            ...$request->all(),
            'route' => RouteCollection::from($request->route()),
        ];

        return new $called($parameters);
    }
}
