<?php

namespace Enraiged\Support\Builders;

/**
 *  @todo
 */
class UriBuilder
{
    /** @var  array  The builder attributes. */
    protected $attributes;

    /**
     *  @param  array   $attributes
     */
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     *  Process the uri attributes and return the result.
     *
     *  @return array
     */
    public function uri(): array
    {
        return $this->attributes;
    }

    /**
     *  Create an instance of the UriBuilder and return the result.
     *
     *  @param  array   $attributes
     *  @return array
     */
    public static function From($attributes): array
    {
        return (new self($attributes))->uri();
    }
}
