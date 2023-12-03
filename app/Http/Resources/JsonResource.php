<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Resources\Json\JsonResource as IlluminateResource;
use Illuminate\Support\Collection;

abstract class JsonResource extends IlluminateResource
{
    /** @var  string|null  The data wrapper that should be applied. */
    public static $wrap = null;

    /** @var  array  The array of actions available for this resource. */
    protected $actions = [];

    /** @var  string  An optional, specific attribute to evaluate. */
    protected $attribute;

    /** @var  bool  Whether or not to include a created_at resource. */
    protected $created = false;

    /** @var  bool  Whether or not to include a updated_at resource. */
    protected $updated = false;

    /**
     *  Get or set a specific resource attribute.
     *
     *  @param  string  $attribute
     *  @return mixed
     */
    public function attribute($attribute = null)
    {
        if ($attribute) {
            $this->attribute = $attribute;

            return $this;
        }

        return $this->attribute();
    }

    /**
     *  Return the generated URL to a named route.
     *
     *  @param  array|string  $name
     *  @param  mixed  $parameters
     *  @return string
     */
    public function route($name, $parameters = [])
    {
        return route($name, $parameters, config('enraiged.app.absolute_uris'));
    }

    /**
     *  Return a new JsonResource.
     *
     *  @param  mixed   $collection
     *  @return \Illuminate\Http\Resources\Json\JsonResource|array
     */
    public static function From($collection)
    {
        $called = get_called_class();
        $class = get_class($collection);

        $resource = ($class === Collection::class || $class === EloquentCollection::class)
            ? $called::collection($collection)
            : new $called($collection);

        return $resource;
    }

    /**
     *  Return a new JsonResource.
     *
     *  @param  mixed   $collection
     *  @param  string  $attribute
     *  @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public static function FromAttribute($collection, $attribute)
    {
        $called = get_called_class();

        return (new $called($collection))->attribute($attribute);
    }
}
