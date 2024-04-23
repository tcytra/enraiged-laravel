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
    protected bool $with_created = false;

    /** @var  bool  Whether or not to include a created_at resource. */
    protected bool $with_deleted = false;

    /** @var  bool  Whether or not to include the tracking objects with this resource. */
    protected bool $with_tracking = false;

    /** @var  bool  Whether or not to include a severity level. */
    protected bool $with_severity = false;

    /** @var  bool  Whether or not to include a updated_at resource. */
    protected bool $with_updated = false;

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
     *  Toggle the model created output on.
     *
     *  @return $this
     */
    public function withCreated()
    {
        $this->with_created = true;

        return $this;
    }

    /**
     *  Toggle the model created output off.
     *
     *  @return $this
     */
    public function withoutCreated()
    {
        $this->with_created = false;

        return $this;
    }

    /**
     *  Toggle the model deleted output on.
     *
     *  @return $this
     */
    public function withDeleted()
    {
        $this->with_deleted = true;

        return $this;
    }

    /**
     *  Toggle the model deleted output off.
     *
     *  @return $this
     */
    public function withoutDeleted()
    {
        $this->with_deleted = false;

        return $this;
    }

    /**
     *  Toggle the severity output on.
     *
     *  @return $this
     */
    public function withSeverity()
    {
        $this->with_severity = true;

        return $this;
    }

    /**
     *  Toggle the severity output off.
     *
     *  @return $this
     */
    public function withoutSeverity()
    {
        $this->with_severity = false;

        return $this;
    }

    /**
     *  Toggle all model tracking output on.
     *
     *  @return $this
     */
    public function withTracking()
    {
        $this->with_tracking = true;

        return $this;
    }

    /**
     *  Toggle all model tracking output off.
     *
     *  @return $this
     */
    public function withoutTracking()
    {
        $this->with_tracking = false;

        return $this;
    }

    /**
     *  Toggle the model updated output on.
     *
     *  @return $this
     */
    public function withUpdated()
    {
        $this->with_updated = true;

        return $this;
    }

    /**
     *  Toggle the model updated output off.
     *
     *  @return $this
     */
    public function withoutUpdated()
    {
        $this->with_updated = false;

        return $this;
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
