<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as IlluminateJsonResource;

abstract class JsonResource extends IlluminateJsonResource
{
    /** @var  string|null  The "data" wrapper that should be applied.*/
    public static $wrap;
}
