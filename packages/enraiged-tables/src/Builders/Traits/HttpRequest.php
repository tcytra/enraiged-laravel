<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Tables\Requests\TableRequest;

trait HttpRequest
{
    /** @var  \Enraiged\Tables\Requests\TableRequest  The http request instance. */
    protected TableRequest $request;

    /** @var  string  The uri for the table data request. */
    protected string $uri;

    /**
     *  Return the request instance.
     *
     *  @return \Enraiged\Tables\Requests\TableRequest
     */
    public function request(): TableRequest
    {
        return $this->request;
    }

    /**
     *  Return the uri for the table data request.
     *
     *  @return string
     */
    public function assembleTemplateUri(): string
    {
        $uri = $this->uri;

        if (preg_match('/\./', $uri)) {
            $uri = route($uri, [], config('enraiged.tables.absolute_uris'));
        }

        return '/'.trim($uri, '/');
    }
}
