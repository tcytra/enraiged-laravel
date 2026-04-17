<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as IlluminateJsonResource;

abstract class JsonResource extends IlluminateJsonResource
{
    /** @var  string|null  The "data" wrapper that should be applied.*/
    public static $wrap;

    /**
     *  Determine the dynamic status of the user.
     *
     *  @return string
     */
    protected function status(): string
    {
        if ($this->isDeleted) {
            return 'deleted';
        }

        if (!$this->isActive) {
            return 'inactive';
        }

        return 'active';
    }
}
