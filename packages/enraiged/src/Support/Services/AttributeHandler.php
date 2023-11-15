<?php

namespace Enraiged\Support\Services;

abstract class AttributeHandler
{
    /** @var  array  The array of attributes. */
    protected $attributes;

    /**
     *  Create an instance of the AttributeHandler.
     *
     *  @param  array   $attributes
     *  @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     *  Return the value for a named attribute.
     *
     *  @param  string  $index
     *  @return mixed
     */
    public function get($index)
    {
        return $this->attributes[$index];
    }

    /**
     *  Determine if the attributes has a named value.
     *
     *  @param  string  $index
     *  @return bool
     */
    public function has($index)
    {
        return key_exists($index, $this->attributes);
    }

    /**
     *  Determine if a named value is definitively true.
     *
     *  @param  string  $index
     *  @return bool
     */
    public function isTrue($index)
    {
        return $this->has($index)
            && $this->get($index) === true;
    }

    /**
     *  Set the value for a named attribute.
     *
     *  @param  string  $index
     *  @param  mixed   $value = null
     *  @return self
     */
    public function set($index, $value = null)
    {
        $this->attributes[$index] = $value;

        return $this;
    }

    /**
     *  Return the array of pivot attributes.
     *
     *  @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     *  Create and return an instance of PivotAttributes.
     *
     *  @param  array   $attributes
     *  @return self
     */
    public static function From(array $attributes = [])
    {
        $class = get_called_class();

        return (new $class($attributes))->handle();
    }
}
