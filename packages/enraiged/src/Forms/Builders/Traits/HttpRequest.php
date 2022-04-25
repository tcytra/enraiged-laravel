<?php

namespace Enraiged\Forms\Builders\Traits;

trait HttpRequest
{
    /** @var  object  The http request. */
    protected $request;

    /**
     *  Return the request.
     *
     *  @return \Illuminate\Http\Request
     */
    public function request()
    {
        return $this->request;
    }
}
