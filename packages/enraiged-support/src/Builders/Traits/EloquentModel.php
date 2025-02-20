<?php

namespace Enraiged\Support\Builders\Traits;

use Illuminate\Database\Eloquent\Model;

trait EloquentModel
{
    /** @var  Model|string  The database model for the builder configuration. */
    protected $model;

    /**
     *  Get the builder database model for the configuration.
     *
     *  @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     *  Set the builder database model for the configuration.
     *
     *  @param  \Illuminate\Database\Eloquent\Model|string  $model = null
     *  @return self
     */
    public function setModel($model = null)
    {
        if ($model instanceof Model || (new $model) instanceof Model) {
            $this->model = $model;
        }

        return $this;
    }
}
