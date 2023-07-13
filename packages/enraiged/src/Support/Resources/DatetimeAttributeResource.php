<?php

namespace Enraiged\Support\Resources;

use App\Http\Resources\JsonResource;

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
     *  Return the created_at date for this resource.
     *
     *  @return string
     */
    public function createdAtDate()
    {
        return $this->created_at
            ? $this->attribute('created_at')->toArray(request())['date']
            : null;
    }

    /**
     *  Return the deleted_at date for this resource.
     *
     *  @return string
     */
    public function deletedAtDate()
    {
        return $this->deleted_at
            ? $this->attribute('deleted_at')->toArray(request())['date']
            : null;
    }

    /**
     *  Return the updated_at date for this resource.
     *
     *  @return string
     */
    public function updatedAtDate()
    {
        return $this->updated_at
            ? $this->attribute('updated_at')->toArray(request())['date']
            : null;
    }

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $attribute = $this->attribute;
        $this->user = $request->user();
        $this->datetime = $this->datetimezone($this->{$attribute});
        $this->timestamp = $this->timezonestamp($this->{$attribute});

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
        $default = 'Y-m-d';
        $format = $this->user
            ? ($this->user->dateformat ?? $default)
            : $default;

        return date($format, $this->timestamp);
    }

    /**
     *  Format and return the time formatted to the user preference.
     *
     *  @return string
     */
    protected function time()
    {
        $default = 'g:i a';
        $format = $this->user
            ? ($this->user->timeformat ?? $default)
            : $default;

        return date($format, $this->timestamp);
    }

    /**
     *  Return a timezoned date/time, optionally from a provided datetime value.
     *
     *  @param  mixed   $datetime
     *  @param  string  $format
     *  @return string
     */
    private function datetimezone($datetime = null, $format = 'Y-m-d H:i:s')
    {
        return date($format, $this->timezonestamp($datetime));
    }

    /**
     *  Return a timezone converted unix timestamp from the provided datetime/timestamp.
     *
     *  @param  mixed   $datetime = null
     *  @param  string  $timezone = null
     *  @return mixed
     */
    private function timezonestamp($datetime = null, $timezone = null)
    {
        $offset = $this->timezone_offset_inverse($timezone);

        return strtotime("{$offset} hrs", timestamp($datetime));
    }

    /**
     *  Return the +/- UTC offset integer of the provided (or default) timezone.
     *
     *  @param  string  $timezone = null
     *  @return string
     */
    function timezone_offset($timezone = null)
    {
        $timezone = new \DateTimeZone(!empty($timezone) ? $timezone : $this->timezone());
        $datetime = new \DateTime("now", $timezone);

        return sprintf("%+d", ($datetime->getOffset() /60 /60));
    }

    /**
     *  Return the +/- UTC offset inverse of the provided (or default) timezone.
     *
     *  @param  string  $timezone = null
     *  @return string
     */
    private function timezone_offset_inverse($timezone = null)
    {
        $timezone = new \DateTimeZone(!empty($timezone) ? $timezone : $this->timezone());
        $datetime = new \DateTime("now", $timezone);

        return sprintf("%+d", ($datetime->getOffset() /60 /60) *-1);
    }

    /**
     *  Return the most user applicable timezone if possible, or default to alternate.
     *
     *  @return string
     */
    private function timezone()
    {
        return $this->user && !empty($this->user->timezone)
            ? $this->user->timezone
            : config('enraiged.app.timezone');
    }
}
