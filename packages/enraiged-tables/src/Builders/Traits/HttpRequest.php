<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Support\Collections\RequestCollection;

trait HttpRequest
{
    /** @var  \Enraiged\Support\Collections\RequestCollection  The collected http request. */
    protected RequestCollection $request;

    /** @var  string  The uri for the table data request. */
    protected string $uri;

    /**
     *  Return the request instance.
     *
     *  @return \Illuminate\Support\Collection
     */
    public function request(): RequestCollection
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
            return route($uri, [], config('enraiged.tables.absolute_uris'));
        }

        return '/'.trim($uri, '/');
    }
}
