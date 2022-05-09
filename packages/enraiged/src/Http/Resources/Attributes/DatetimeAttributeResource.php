<?php

namespace Enraiged\Http\Resources\Attributes;

use Enraiged\Http\Resources\JsonResource;

class DatetimeAttributeResource extends JsonResource
{
    /** @var  string  The formatted and timezoned date and time of this attribute. */
    protected $datetime;

    /** @var  bool  Whether or not to include the human readable (contextual) formats. */
    protected $readable = false;

    /** @var  string  The formatted and timezoned unix timestamp of this attribute. */
    protected $timestamp;

    /** @var  User  The request user. */
    protected $user;

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $this->user = $request->user();

        $attribute = $this->attribute;
        $this->datetime = datetimezone($this->{$attribute});
        $this->timestamp = timezonestamp($this->{$attribute});

        $resource = [
            'date' => datei18n($this->date()),
            'time' => $this->time(),
            'datetime' => datei18n($this->datetime),
            'timestamp' => $this->timestamp,
        ];

        if ($this->readable) {
            $offset = timezone_offset();
            $now = strtotime("{$offset} hours", time());

            $resource['elapsed'] = elapsed($this->timestamp, $now);
            $resource['meridiem'] = meridiem($this->timestamp, $now);
        }

        return $resource;
    }

    /**
     *  Format and return the time formatted to the user preference.
     *
     *  @return string
     */
    protected function date()
    {
        $format = $this->user->dateformat ?? 'Y-m-d';

        return date($format, $this->timestamp);
    }

    /**
     *  Format and return the time formatted to the user preference.
     *
     *  @return string
     */
    protected function time()
    {
        $format = $this->user->military_time == true ? 'G\hi' : 'g:i a';

        return date($format, $this->timestamp);
    }
}
