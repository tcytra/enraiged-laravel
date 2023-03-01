<?php

namespace App\Http\Resources\DatetimeResources;

trait AtTimestamp
{
    /**
     *  @param  string  $value
     *  @return array|null
     */
    private function atTimestamp($value)
    {
        if ($value) {
            $timestamp = timezonestamp($this->completed_at);

            return [
                'data' => date('c', $timestamp),
                'long' => date('l, F j, Y', $timestamp),
                'short' => date('M j, Y', $timestamp),
                'timestamp' => $timestamp,
            ];
        }

        return null;
    }
}
