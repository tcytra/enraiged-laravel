<?php

namespace App\Enums;

final class Languages
{
    /**
     *  @return array
     */
    public static function Select()
    {
        return collect(config('app.locales'))
            ->transform(function ($name, $index) {
                return [
                    'id' => $index,
                    'name' => __($name, [], $index),
                ];
            })
            ->values()
            ->toArray();
    }
}
