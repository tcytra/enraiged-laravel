<?php

/**
 *  Return a date that does not fall on a holiday or weekend in a specified country.
 *
 *  @param  string  $country
 *  @param  mixed   $datetime
 *  @param  string  $defer
 *  @return string
 */
function avoid_holiday($country, $datetime, $defer = '+1 weekday')
{
    if (!preg_match('/^([0-9]+)$/', $datetime))
    { $datetime = strtotime($datetime); }

    $datetime = (in_array(date('Y-m-d', $datetime), holidays($country)) || in_array(date('w', $datetime), [0,6]))
        ? strtotime($defer, $datetime)
        : $datetime;

    return $datetime;
}

/**
 *  Return a simple preg_replace formatted date string.
 *
 *  @param  string  $datetime
 *  @return string
 */
function datei18n($datetime)
{
    $locale = app()->getlocale();
    $language = config("enraiged.languages.{$locale}");
    $defaults = config('enraiged.languages.en');

    $patterns = collect(array_merge($defaults['month_abbrs'], $defaults['months']))
        ->transform(fn ($each) => "/{$each}/")
        ->toArray();
    $replacements = array_merge($language['month_abbrs'], $language['months']);

    return preg_replace($patterns, $replacements, $datetime);
}

/**
 *  Return a formatted date/time, optionally from a provided datetime value.
 *
 *  @param  mixed   $datetime = null
 *  @param  string  $format = 'Y-m-d H:i:s'
 *  @param  bool    $translate = false
 *  @return string
 */
function datetime($datetime = null, $format = 'Y-m-d H:i:s', $translate = false)
{
    if (is_array($datetime)) {
        return collect($datetime)
            ->transform(fn ($each) => datetime($each, $format, $translate))
            ->toArray();
    }

    $formatted = date($format, timestamp($datetime ?? time()));

    return $translate
        ? datei18n($formatted)
        : $formatted;
}

/**
 *  Return a timezoned date/time, optionally from a provided datetime value.
 *
 *  @param  mixed   $datetime
 *  @param  string  $format
 *  @return string
 */
function datetimezone($datetime = null, $format = 'Y-m-d H:i:s')
{
    return date($format, timezonestamp($datetime));
}

/**
 *  Return a timezoned date/time for querying records, optionally from a provided datetime value.
 *
 *  @param  mixed   $datetime
 *  @param  string  $format
 *  @return string
 */
function datetimezone_at($datetime = null, $format = 'Y-m-d H:i:s')
{
    return date($format, timezonestamp_at($datetime));
}

/**
 *  Return a human readable string representing an elapsed period of time.
 *
 *  @param  mixed   $since
 *  @param  mixed   $datetime = 0
 *  @param  bool    $strict = true
 *  @return string
 */
function elapsed($since, $datetime = 0, $strict = true)
{
    $since = timestamp($since);
    $datetime = $datetime ? timestamp($datetime) : time();
    $lapse = ($datetime - $since);

    $array = [
        ['diff' => 31536000, 'text' => __('year')],
        ['diff' => 2592000, 'text' => __('month')],
        ['diff' => 604800, 'text' => __('week')],
        ['diff' => 86400, 'text' => __('day')],
        ['diff' => 3600, 'text' => __('hour')],
        ['diff' => 60, 'text' => __('minute')],
        ['diff' => 1, 'text' => __('second')],
    ];

    $return = 'a moment';

    for ($i=0; $i<count($array); $i++) {
        $item = $array[$i];

        if ($lapse > $item['diff']) {
            $diff = floor($lapse / $item['diff']);

            if ($diff == 1)
            { $return = __('a'); }
            else
            if ($diff == 2)
            { $return = __('a couple of'); }
            else
            if ($diff == 3)
            { $return = __('a few'); }
            else
            { $return = ($strict) ? $diff : __('several'); }

            $return = "{$return} {$item['text']}".(($diff > 1) ? 's' : '');

            break;
        }
    }

    return __(':elapsed ago', ['elapsed' => $return]);
}

/**
 *  Return the array value of the furthest value in time, optionally from a specified timestamp.
 *
 *  @param  array   $array
 *  @param  mixed   $from = null
 *  @return mixed
 */
function furthest_datetime($array, $from = null)
{
    $index = furthest_datetime_index($array, $from = null);

    return $array[$index];
}

/**
 *  Return the array index of the furthest value in time, optionally from a specified timestamp.
 *
 *  @param  array   $array
 *  @param  mixed   $from = null
 *  @return int
 */
function furthest_datetime_index($array, $from = null)
{
    $from = $from ? timestamp($from) : time();
    $furthest = null;
    $index = null;

    for ($i = 0; $i < count($array); $i++) {
        $timestamp = timestamp($array[$i]);
        $difference = $timestamp - $from;

        if ($difference < 0) {
            $difference = $difference *-1;
        }

        if (!$furthest || $difference > $furthest) {
            $index = $i;
        }
    }

    return $index;
}

/**
 *  Return an array of holiday dates for a country for a number of years.
 *
 *  $country is required as an iso alpha-2 country code; default: CA
 *  $region is optional, not implemented at this time
 *  $years will accept an array of years or a single year; default: current year plus one year
 *
 *  @param  string  $country = 'CA'
 *  @param  array   $years = []
 *
 *  @todo   Regions? More countries?
 */
function holidays($country = 'CA', $years = [])
{
    $dates = [];
    $years = !is_array($years) ? [$years] : (!count($years) ? [date("Y") +0, date("Y") +1] : $years);

    foreach ($years as $year) {
        switch($country) {
            // tested against: //https://www.officeholidays.com/countries/canada/2023
            case 'CA': $dates = array_merge($dates, [
                in_array(date("w", strtotime("jan 1 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("jan 1 {$year}"))) : "{$year}-01-01",
                date("Y-m-d", strtotime("{$year} february +3 monday")),
                date("Y-m-d", strtotime("previous friday", easter_date($year))),
                (date("w", strtotime("may 24 {$year}")) == 1) ? "{$year}-05-24" : date("Y-m-d", strtotime("previous monday", strtotime("may 24 {$year}"))),
                in_array(date("w", strtotime("jul 1 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("jul 1 {$year}"))) : "{$year}-07-01",
                date("Y-m-d", strtotime("{$year} august +1 monday")),
                date("Y-m-d", strtotime("{$year} september +1 monday")),
                date("Y-m-d", strtotime("{$year} october +2 monday")),
                in_array(date("w", strtotime("nov 11 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("nov 11 {$year}"))) : "{$year}-11-11",
                in_array(date("w", strtotime("dec 25 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("dec 25 {$year}"))) : "{$year}-12-25",
            ]); break;
            // tested against: //https://www.officeholidays.com/countries/usa/2023
            case 'US': $dates = array_merge($dates, [
                in_array(date("w", strtotime("jan 1 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("jan 1 {$year}"))) : "{$year}-01-01",
                date("Y-m-d", strtotime("{$year} january +3 monday")),
                date("Y-m-d", strtotime("{$year} february +3 monday")),
                (date("w", strtotime("may 31 {$year}")) == 1) ? "{$year}-05-31" : date("Y-m-d", strtotime("previous monday", strtotime("may 31 {$year}"))),
                in_array(date("w", strtotime("jun 19 {$year}")), [0,6]) ? date("Y-m-d", strtotime("previous friday", strtotime("jun 19 {$year}"))) : "{$year}-06-19",
                in_array(date("w", strtotime("jul 4 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("jul 4 {$year}"))) : "{$year}-07-04",
                date("Y-m-d", strtotime("{$year} september +1 monday")),
                date("Y-m-d", strtotime("{$year} october +2 monday")),
                date("Y-m-d", strtotime("{$year} november +4 thursday")),
                in_array(date("w", strtotime("dec 25 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("dec 25 {$year}"))) : "{$year}-12-25",
            ]); break;
        }
    }

    return $dates;
}

/**
 *  Determine if a provided string is a valid date.
 *
 *  @param  string  $value
 *  @return bool
 */
function is_date($value)
{
    if (!$stamp = strtotime($value)) {
        return false;
    }

    [$year, $month, $date] = explode('-', date('Y-n-j', $stamp));

    return checkdate($month, $date, $year);
}

/**
 *  Determine if a provided date falls on a holiday.
 *
 *  @param  int|string  $date
 *  @param  string  $country = 'CA'
 *  @return bool
 */
function is_holiday($date, $country = 'CA')
{
    $timestamp = timestamp($date);
    $year = date('Y', $timestamp);

    return in_array(date('Y-m-d', $timestamp), holidays($country, $year));
}

/**
 *  Determine if a provided date falls on a weekend.
 *
 *  @param  int|string  $date
 *  @return bool
 */
function is_weekend($date)
{
    $timestamp = timestamp($date);

    return in_array(date("w", $timestamp), [0,6]);
}

/**
 *  Return a human readable string representing the general time of day.
 *
 *  @param  mixed   $datetime
 *  @return string
 */
function meridiem($datetime)
{
    $timestamp = timestamp($datetime);

    $hour = date("Gi", $timestamp);
    $today = ($timestamp > strtotime("today")) ? true : false;

    $determiner = ($today ? 'this' : 'in the');

    if ($hour < 400)
    { $return = __("very early {$determiner} morning"); }
    else
    if ($hour < 800)
    { $return = __("early {$determiner} morning"); }
    else
    if ($hour < 1200)
    { $return = __("{$determiner} morning"); }
    else
    if ($hour < 1600)
    { $return = __("{$determiner} afternoon"); }
    else
    if ($hour < 2000)
    { $return = __("{$determiner} evening"); }
    else
    { $return = __("late ".($today ? "tonight" : "at night")); }

    return $return;
}

/**
 *  Return the array value of the nearest value in time, optionally from a specified timestamp.
 *
 *  @param  array   $array
 *  @param  mixed   $from = null
 *  @return mixed
 */
function nearest_datetime($array, $from = null)
{
    $index = nearest_datetime_index($array, $from = null);

    return $array[$index];
}

/**
 *  Return the array index of the nearest value in time, optionally from a specified timestamp.
 *
 *  @param  array   $array
 *  @param  mixed   $from = null
 *  @return int
 */
function nearest_datetime_index($array, $from = null)
{
    $from = $from ? timestamp($from) : time();
    $nearest = null;
    $index = null;

    for ($i = 0; $i < count($array); $i++) {
        $timestamp = timestamp($array[$i]);
        $difference = $timestamp - $from;

        if ($difference < 0) {
            $difference = $difference *-1;
        }

        if (!$nearest || $difference < $nearest) {
            $nearest = $difference;
            $index = $i;
        }
    }

    return $index;
}

/**
 *  Return the next consecutive business day from the provided date.
 *
 *  @param  string  $country
 *  @param  mixed   $datetime  Will accept a unix timestamp or php strtotime() argument
 *  @param  string  $format = null  Will accept a php strtotime() argument
 *  @return string
 */
function next_business_day($country, $datetime, $format = null)
{
    $next_day = strtotime('+1 weekday', timestamp($datetime));
    $timestamp = avoid_holiday($country, $next_day);

    return ($format ? date($format, $timestamp) : $timestamp);
}

/**
 *  Return the timestamp of the next interval in minutes.
 *
 *  @param  int     $interval
 *  @param  mixed   $datetime = null
 *  @return int
 */
function next_interval($interval, $datetime = null)
{
    $timestamp = timestamp($timestamp);

    $minutes = floor( date('i', $timestamp) / $interval ) * $interval;
    $flatten = timestamp(date("Y-m-d H:{$minutes}:00", $timestamp));
    $inflate = strtotime("+{$interval} minutes", $flatten);

    return $inflate;
}

/**
 *  Return the previous consecutive business day from the provided date.
 *
 *  @param  string  $country
 *  @param  mixed   $datetime  Will accept a unix timestamp or php strtotime() argument
 *  @param  string  $format = null  Will accept a php strtotime() argument
 *  @return string
 */
function previous_business_day($country, $datetime, $format = null)
{
    $previous_day = strtotime('-1 weekday', timestamp($datetime));
    $timestamp = avoid_holiday($country, $previous_day, '-1 weekday');

    return ($format ? date($format, $timestamp) : $timestamp);
}

/**
 *  Return the first day of the current quarterly period.
 *
 *  @param  string  $format = null
 *  @return string
 *
 *  @todo   Apply an offset for non-standard quarters
 */
function quarter_first_date($format = null)
{
    $Y = date('Y');
    $m = str_pad((ceil(date('m') /3) *3) -2, 2, "0", STR_PAD_LEFT);
    $timestamp = strtotime("{$Y}-{$m}-01");

    return ($format ? date($format, $timestamp) : $timestamp);
}

/**
 *  Return the final day of the current quarterly period
 *  
 *  @param  string  $format = null
 *  @return string
 */
function quarter_final_date($format = null)
{
    $Y = date('Y');
    $m = str_pad((ceil(date('m') /3) *3), 2, "0", STR_PAD_LEFT);
    $d = date('t', strtotime("{$Y}-{$m}"));
    $timestamp = strtotime("{$Y}-{$m}-{$d}");

    return ($format ? date($format, $timestamp) : $timestamp);
}

/**
 *  Return a unix timestamp equivalent of a provided php date.
 *
 *  @param  mixed   $datetime = null
 *  @return int
 */
function timestamp($datetime = null)
{
    return preg_match("/^([0-9]+)$/", $datetime ?: time())
        ? $datetime ?: time()
        : strtotime($datetime);
}

/**
 *  Return the most user applicable timezone if possible, or default to alternate.
 *
 *  @return string
 */
function timezone()
{
    return user() && !empty(user()->timezone)
        ? user()->timezone
        : config('enraiged.app.timezone');
}

/**
 *  Return a timezone converted unix timestamp from the provided datetime/timestamp.
 *
 *  @param  mixed   $datetime = null
 *  @param  string  $timezone = null
 *  @return mixed
 */
function timezonestamp($datetime = null, $timezone = null)
{
    $offset = timezone_offset_inverse($timezone);

    return strtotime("{$offset} hrs", timestamp($datetime));
}

/**
 *  Return a timezone converted unix timestamp for querying records from the provided datetime/timestamp.
 *
 *  @param  mixed   $datetime = null
 *  @param  string  $timezone = null
 *  @return mixed
 */
function timezonestamp_at($datetime = null, $timezone = null)
{
    $offset = timezone_offset($timezone);

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
    $timezone = new \DateTimeZone(!empty($timezone) ? $timezone : timezone());
    $datetime = new \DateTime("now", $timezone);

    return sprintf("%+d", ($datetime->getOffset() /60 /60));
}

/**
 *  Return the +/- UTC offset inverse of the provided (or default) timezone.
 *
 *  @param  string  $timezone = null
 *  @return string
 */
function timezone_offset_inverse($timezone = null)
{
    $timezone = new \DateTimeZone(!empty($timezone) ? $timezone : timezone());
    $datetime = new \DateTime("now", $timezone);

    return sprintf("%+d", ($datetime->getOffset() /60 /60) *-1);
}

/**
 *  Return a utc formatted date/time, optionally from a provided datetime value.
 *
 *  @param  mixed   $datetime = null
 *  @param  string  $format = 'Y-m-d H:i:s'
 *  @return string
 */
function utcdatetime($datetime = null, $format = 'Y-m-d H:i:s')
{
    if (is_array($datetime)) {
        return collect($datetime)
            ->transform(fn ($each) => utcdatetime($each, $format))
            ->toArray();
    }

    return date($format, utcstamp($datetime));
}

/**
 *  Return a utc timezone converted unix timestamp from the provided datetime/timestamp.
 *
 *  @param  mixed   $datetime = null
 *  @param  string  $timezone = null
 *  @return mixed
 */
function utcstamp($datetime = null, $timezone = null)
{
    $offset = timezone_offset($timezone);

    return strtotime("{$offset} hrs", timestamp($datetime));
}
