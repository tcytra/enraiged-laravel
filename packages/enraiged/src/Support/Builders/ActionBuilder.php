<?php

namespace Enraiged\Support\Builders;

/**
 *  @todo
 */
class ActionBuilder
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
     *  Process the action attributes and return the result.
     *
     *  @return array
     */
    public function action(): array
    {
        return $this->attributes;
    }

    /**
     *  Create an instance of the ActionBuilder and return the result.
     *
     *  @param  array   $attributes
     *  @return array
     */
    public static function From($attributes): array
    {
        return (new self($attributes))->uri();
    }
}
