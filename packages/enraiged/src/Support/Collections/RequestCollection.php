<?php

namespace Enraiged\Support\Collections;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RequestCollection extends Collection // this class exists because Illuminate\Http\Request cannot be serialized
{
    use Traits\Filled;

    /**
     *  Return the RouteCollection.
     *
     *  @return \Enraiged\Support\Collections\RouteCollection
     */
    public function route(): RouteCollection
    {
        return $this->get('_route');
    }

    /**
     *  Get the authenticated user who made the request.
     *
     *  @return mixed
     */
    public function user()
    {
        return $this->get('_authenticated');
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
            '_authenticated' => $request->user(),
            '_route' => RouteCollection::from($request->route()),
            ...$request->all(),
        ];

        return new $called($parameters);
    }
}
