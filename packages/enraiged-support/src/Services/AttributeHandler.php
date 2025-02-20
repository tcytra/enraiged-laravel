<?php

namespace Enraiged\Support\Services;

abstract class AttributeHandler
{
    /** @var  array  The array of attributes. */
    protected $attributes;

    /** @var  bool  Whether this is handling a create. */
    protected $creating = false;

    /** @var  bool  Whether this is handling an update. */
    protected $updating = false;

    /**
     *  Create an instance of the AttributeHandler.
     *
     *  @param  array   $attributes = []
     *  @param  bool    $creating = false
     *  @return void
     */
    public function __construct(array $attributes = [], bool $creating = false)
    {
        if ($creating) {
            $this->creating = true;
        } else {
            $this->updating = true;
        }

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
     *
    public function isTrue($index)
    {
        return $this->has($index)
            && $this->get($index) === true;
    }*/

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
     *  Handle the attributes for creating a new model.
     *
     *  @param  array   $attributes
     *  @return void
     */
    public static function Creating(array $attributes = [])
    {
        $called = get_called_class();
        $class = new $called($attributes, true);

        return $class
            ->handle();
    }

    /**
     *  Handle the attributes for updating a model.
     *
     *  @param  array   $attributes
     *  @return void
     */
    public static function From(array $attributes = [])
    {
        $called = get_called_class();
        $class = new $called($attributes);

        return $class
            ->handle();
    }

    /**
     *  Handle the attributes for updating a model (alias of ::from).
     *
     *  @param  array   $attributes
     *  @return void
     */
    public static function Updating(array $attributes = [])
    {
        return self::From($attributes);
    }
}
