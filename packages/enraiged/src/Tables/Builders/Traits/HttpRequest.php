<?php

namespace Enraiged\Tables\Builders\Traits;

trait HttpRequest
{
    /** @var  object  The request collection. */
    protected $request;

    /** @var  string  The uri for the table data request. */
    protected $uri;

    /**
     *  Return the request.
     *
     *  @return object
     */
    public function request()
    {
        return $this->request;
    }

    /**
     *  Return the uri for the table data request.
     *
     *  @return string
     */
    public function uri(): string
    {
        $uri = $this->uri;

        if (preg_match('/\./', $uri)) {
            $uri = route($uri, [], config('enraiged.tables.absolute_uris'));
        }

        return '/'.trim($uri, '/');
    }
}
