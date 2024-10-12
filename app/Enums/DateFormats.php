<?php

namespace App\Enums;

final class DateFormats
{
    /** @var  string  The date string to form examples from. */
    private static $example = 'December 31';

    /** @var  array  The date formats available. */
    private static $formats = ['Y-m-d', 'm/d/Y', 'M j, Y', 'F j, Y'];

    /**
     *  @return array
     */
    public static function All()
    {
        return self::$formats;
    }

    /**
     *  @return array
     */
    public static function Select()
    {
        return collect(self::$formats)
            ->transform(function ($each) {
                return [
                    'id' => $each,
                    'name' => datetime(timestamp(self::$example), $each, true),
                ];
            })
            ->toArray();
    }
}
