<?php

namespace App\Enums;

final class Languages
{
    /**
     *  @return array
     */
    public static function Select()
    {
        return collect(config('enraiged.languages'))
            ->transform(function ($each, $index) {
                return [
                    'id' => $index,
                    'name' => __($each['name']),
                ];
            })
            //->sort() // ?
            ->values()
            ->toArray();
    }
}
