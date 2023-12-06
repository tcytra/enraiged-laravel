<?php

namespace Enraiged\Support\Collections;

use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

class RouteCollection extends Collection
{
    use Traits\Filled;

    /**
     *  Create a new collection.
     *
     *  @param  \Illuminate\Contracts\Support\Arrayable  $items
     *  @return void
     */
    public function __construct($items = [])
    {
        $this->items = $this->getArrayableItems($items);

        if (count($items)) {
            if (array_keys($items)[0] === 0) {
                //  ignore for sanity
            } else {
                foreach ($items as $index => $value) {
                    $this->{$index} = $value;
                }
            }
        }
    }

    /**
     *  Determine whether this route has parameters.
     *
     *  @return bool
     */
    public function hasParameters(): bool
    {
        return $this->keys()->count() > 0;
    }

    /**
     *  Get a given parameter from the collection.
     *
     *  @param  string  $name
     *  @param  string|object|null  $default
     *  @return string|object|null
     */
    public function parameter($name, $default = null)
    {
        return $this->has($name)
            ? $this->get($name)
            : $default;
    }

    /**
     *  Get the key / value list of parameters for the route.
     *
     *  @return array
     */
    public function parameters()
    {
        return $this->all();
    }

    /**
     *  Get all of the parameter names for the route.
     *
     *  @return array
     */
    public function parameterNames()
    {
        return $this->keys()->all();
    }

    /**
     *  Create a collection from the provided Route object.
     *
     *  @param  \Illuminate\Routing\Route  $route
     *  @return self
     */
    public static function From(Route $route): self
    {
        $called = get_called_class();

        return new $called($route->parameters());
    }
}
