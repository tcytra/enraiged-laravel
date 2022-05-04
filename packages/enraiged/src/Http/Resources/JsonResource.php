<?php

namespace Enraiged\Http\Resources;

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
     *  @param  mixed   $resource
     *  @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public static function From($resource)
    {
        $called = get_called_class();
        $class = get_class($resource);

        return ($class === Collection::class || $class === EloquentCollection::class)
            ? $called::collection($resource)
            : new $called($resource);
    }

    /**
     *  Return a new JsonResource.
     *
     *  @param  mixed   $resource
     *  @param  string  $attribute
     *  @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public static function FromAttribute($resource, $attribute)
    {
        $called = get_called_class();

        return (new $called($resource))->attribute($attribute);
    }
}
