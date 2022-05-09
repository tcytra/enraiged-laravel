<?php

namespace Enraiged\Profiles\Models\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory as IlluminateHasFactory;

trait HasFactory
{
    use IlluminateHasFactory;

    /**
     *  Create a new factory instance for the model.
     *
     *  @return \Illuminate\Database\Eloquent\Factories\Factory
     *  @static
     */
    protected static function newFactory()
    {
        return new \Enraiged\Profiles\Factories\ProfileFactory;
    }
}
