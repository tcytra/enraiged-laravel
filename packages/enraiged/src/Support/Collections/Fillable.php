<?php

namespace Enraiged\Support\Collections;

trait Fillable
{
    public static function Collection()
    {
        return collect(self::$fillable);
    }

    public static function Except($argument)
    {
        return self::collection()
            ->except($argument)
            ->toArray();
    }

    public static function Only($argument)
    {
        return self::collection()
            ->only($argument)
            ->toArray();
    }
}
