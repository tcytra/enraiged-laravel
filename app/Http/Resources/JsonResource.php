<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Resources\Json\JsonResource as IlluminateResource;
use Illuminate\Support\Collection;

class JsonResource extends IlluminateResource
{
    /** @var  string  The key with which to wrap the data array. */
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
     *  Return a new JsonResource.
     *
     *  @param  mixed   $collection
     *  @param  \Illuminate\Http\Request  $request = null
     *  @return \Illuminate\Http\Resources\Json\JsonResource|array
     */
    public static function From($collection, $request = null)
    {
        $called = get_called_class();
        $class = get_class($collection);

        $resource = ($class === Collection::class || $class === EloquentCollection::class)
            ? $called::collection($collection)
            : new $called($collection);

        return $request
            ? $resource->toArray($request)
            : $resource;
    }

    /**
     *  Return a new JsonResource.
     *
     *  @param  mixed   $collection
     *  @param  string  $attribute
     *  @param  \Illuminate\Http\Request  $request = null
     *  @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public static function FromAttribute($collection, $attribute, $request = null)
    {
        $called = get_called_class();

        $resource = (new $called($collection))->attribute($attribute);

        return $request
            ? $resource->toArray($request)
            : $resource;
    }
}
