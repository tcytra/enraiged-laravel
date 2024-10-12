<?php

namespace App\Enums;

use DateTime;
use DateTimeZone;

final class Timezones
{
    /**
     *  @param  string  $value
     *  @return string|null
     */
    public static function Detailed($value)
    {
        if ($value) {
            $timezone = new DateTimeZone($value);
            $datetime = new DateTime("now", $timezone);
            $offset = sprintf("%+d", $datetime->getOffset() /60 /60);

            return "(GMT{$offset}) {$value}";
        }

        return null;
    }

    /**
     *  @param  string  $country
     *  @return array
     */
    public static function List($country = 'CA')
    {
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country);

        $list = collect($timezones)
            ->transform(fn ($item) => self::detailed($item))
            ->sort()
            ->transform(fn ($item) => self::usable($item));

        return $list->toArray();
    }

    /**
     *  @param  string  $country
     *  @return array
     */
    public static function Select($country = 'CA')
    {
        $options = [];

        foreach (self::list($country) as $timezone) {
            $options[] = [
                'id' => $timezone,
                'name' => self::detailed($timezone),
            ];
        }

        return $options;
    }

    /**
     *  @param  string  $value
     *  @return string
     */
    public static function Usable($value)
    {
        return preg_replace('/^\(.*\)\s/', '', $value);
    }
}
