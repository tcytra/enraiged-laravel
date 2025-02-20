<?php

namespace Enraiged\Support\Database\Traits;

trait AtTimestamp
{
    /**
     *  @param  string  $value
     *  @return object|null
     */
    private function atTimestamp($value): ?object
    {
        if ($value) {
            $timestamp = strtotime($value);
            $timezonestamp = timezonestamp($value);

            return (object) [
                'data' => date('c', $timestamp),
                'elapsed' => elapsed($timestamp),
                'long' => date('l, F j, Y', $timezonestamp),
                'short' => date('M j, Y', $timezonestamp),
                'time' => date('g:i a', $timezonestamp),
                'timestamp' => $timestamp,
            ];
        }

        return null;
    }
}
