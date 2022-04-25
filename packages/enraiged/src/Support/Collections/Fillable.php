<?php

namespace Enraiged\Support\Collections;

use Illuminate\Support\Collection;

trait Fillable
{
    /**
     *  @return \Illuminate\Support\Collection
     */
    public static function Collection(): Collection
    {
        return collect(self::$fillable);
    }

    /**
     *  @param  array|string  $argument
     *  @return array
     */
    public static function Except($argument): array
    {
        return self::collection()
            ->except($argument)
            ->toArray();
    }

    /**
     *  @param  array|string  $argument
     *  @return array
     */
    public static function Only($argument): array
    {
        return self::collection()
            ->only($argument)
            ->toArray();
    }
}
