<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Tables\Support\TableRequestCollection;

trait HttpRequest
{
    /** @var  \Enraiged\Tables\Support\TableRequestCollection  The collected http request. */
    protected TableRequestCollection $request;

    /** @var  string  The uri for the table data request. */
    protected array|string $uri;

    /**
     *  Return the request instance.
     *
     *  @return \Enraiged\Tables\Support\TableRequestCollection
     */
    public function request(): TableRequestCollection
    {
        return $this->request;
    }
}
