<?php

namespace App\System\Support\Database\Traits;

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

            return [
                'date' => date('M j, Y', $timestamp),
                'long' => date('l, F j, Y g:i a', $timestamp),
                'time' => date('g:i a', $timestamp),
                'timestamp' => $timestamp,
            ];
        }

        return null;
    }
}
