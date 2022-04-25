<?php

namespace Enraiged\Forms\Builders\Traits;

trait FormResource
{
    /** @var  object  The templated form resource parameters. */
    protected $resource;

    /** @var  string  The uri for the table data request. */
    protected $uri;

    /**
     *  Get or set the form resource.
     *
     *  @param  array|null  $value = null
     *  @return array|self
     */
    public function resource(array $value = null)
    {
        if ($value) {
            $this->resource = $value;

            return $this;
        }

        return $this->resource;
    }

    /**
     *  Get or set the form uri.
     *
     *  @param  string|null  $value = null
     *  @return string|self
     */
    public function uri(string $value = null)
    {
        if ($value) {
            $this->uri = $value;

            return $this;
        }

        return $this->uri;
    }
}
