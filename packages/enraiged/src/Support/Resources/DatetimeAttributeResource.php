<?php

namespace Enraiged\Support\Resources;

use App\Http\Resources\JsonResource;

class DatetimeAttributeResource extends JsonResource
{
    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $attribute = $this->attribute;
        $datetime = datetime($this->{$attribute});
        $timestamp = timestamp($this->{$attribute});
        $offset = timezone_offset();
        $now = strtotime("{$offset} hours", time());

        return [
            'date' => date('F j, Y', $timestamp),
            'time' => date('g:ia', $timestamp),
            'datetime' => $datetime,
            'elapsed' => elapsed($datetime, $now),
            'meridiem' => meridiem($datetime, $now),
            'timestamp' => timestamp($datetime),
        ];
    }
}
