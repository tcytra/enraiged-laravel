<?php

use Illuminate\Support\Facades\Auth;

/**
 *  avoid_holiday()
 *  Return a date that does not fall on a holiday or weekend
 *  
 *  @param  mixed $stamp
 *  @param  mixed $format
 *  @return string
 */
function avoid_holiday($stamp, $format = null)
{
    if (!preg_match("/^([0-9]+)$/", $stamp))
    { $stamp = strtotime($stamp); }

    $stamp = (in_array(date("Y-m-d", $stamp), holidays()) || in_array(date("w", $stamp), [0,6]))
        ? strtotime("+1 weekday", $stamp)
        : $stamp;

    return ($format ? date($format, $stamp) : $stamp);
}

/**
 *  datetime()
 *  Return a formatted date/time from a provided datetime value.
 *  
 *  @param  mixed   $stamp = null
 *  @param  string  $format = 'Y-m-d H:i:s'
 *  @return int
 */
function datetime($stamp = null, $format = 'Y-m-d H:i:s')
{
    return date($format, timestamp($stamp ?? time()));
}

/**
 *  elapsed()
 *  Return a human readable string representing an elapsed period of time
 *  
 *  @param	mixed	$since
 *  @param	mixed	$stamp = 0
 *  @param	bool	$strict = true
 *  @return	string
 */
function elapsed($since, $stamp = 0, $strict = true)
{
    $since = timestamp($since);
    $stamp = $stamp ? timestamp($stamp) : time();
    $lapse = ($stamp - $since);

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
        $item	= $array[$i];

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
 *  holidays()
 *  Return an array of holiday dates for a country for a number of years
 *  + $country is required as an iso alpha-2 country code; default: CA
 *  + $region is optional, not implemented at this time
 *  + $years will accept an array of years or a single year; default: current year plus one year
 *  
 *  @param  string  $country = 'CA'
 *  @param  string  $region = null
 *  @param  array   $years = []
 *
 *  @todo   Regions? More countries?
 */
function holidays($country = 'CA', $region = null, $years = [])
{
    $dates	= [];
    $years	= !is_array($years) ? [$years] : (!count($years) ? [date("Y"),date("Y")+1] : $years);

    foreach ($years as $year) {
        switch($country) {
            // tested against: //https://www.officeholidays.com/countries/canada/{2018,2019}.php
            case 'CA': $dates = array_merge($dates, [
                date("Y-01-01"),
                date("Y-m-d", strtotime("{$year} february +3 monday")),
                date("Y-m-d", strtotime("previous friday", easter_date($year))),
                date("Y-m-d", strtotime("next monday", easter_date($year))),
                (date("w", strtotime("may 24 {$year}")) == 1) ? "{$year}-05-24" : date("Y-m-d", strtotime("previous monday", strtotime("may 24 {$year}"))),
                in_array(date("w", strtotime("jul 1 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("jul 1 {$year}"))) : "{$year}-07-01",
                date("Y-m-d", strtotime("{$year} august +1 monday")),
                date("Y-m-d", strtotime("{$year} september +1 monday")),
                date("Y-m-d", strtotime("{$year} october +2 monday")),
                in_array(date("w", strtotime("nov 11 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("nov 11 {$year}"))) : "{$year}-11-11",
                in_array(date("w", strtotime("dec 25 {$year}")), [0,6]) ? date("Y-m-d", strtotime("next monday", strtotime("dec 25 {$year}"))) : "{$year}-12-25",
                "{$year}-12-26"
            ]); break;
        }
    }

    return $dates;
}

/**
 *  meridiem()
 *  Return a human readable string representing the general time of day
 *  
 *  @param	string	$stamp
 *  @return	string
 */
function meridiem($stamp)
{
    $stamp = timestamp($stamp);

    $hour = date("Gi", $stamp);
    $today = ($stamp > strtotime("today")) ? true : false;

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
 *  next_business_day()
 *  Return the next consecutive business day after the provided date
 *  + Stamp is required and will accept unix timestamp or php strtotime() argument
 *  + Format is optional and will accept a php strtotime() argument
 *  
 *  @param  string  $stamp
 *  @param  string  $format = null
 *  @return string
 */
function next_business_day($stamp, $format = null)
{
    $stamp = avoid_holiday( strtotime("+1 weekday", timestamp($stamp)) );

    return ($format ? date($format, $stamp) : $stamp);
}

/**
 *  next_interval()
 *  Return the timestamp of the next interval in minutes.
 *
 *  @param  int     $interval
 *  @param  mixed   $stamp = null
 *  @return int
 */
function next_interval($interval, $stamp = null)
{
    $stamp = timestamp($stamp);

    $minutes = floor( date('i', $stamp) / $interval ) * $interval;
    $flatten = timestamp(date("Y-m-d H:{$minutes}:00", $stamp));
    $inflate = strtotime("+{$interval} minutes", $flatten);

    return $inflate;
}

/**
 *  quarter_first_date()
 *  Return the first day of the current quarterly period
 *  
 *  @param  string  $format = null
 *  @return string
 */
function quarter_first_date($format = null)
{
    $Y = date('Y');
    $m = str_pad((ceil(date('m') /3) *3) -2, 2, "0", STR_PAD_LEFT);
    $stamp = strtotime("{$Y}-{$m}-01");

    return ($format ? date($format, $stamp) : $stamp);
}

/**
 *  quarter_final_date()
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
    $stamp = strtotime("{$Y}-{$m}-{$d}");

    return ($format ? date($format, $stamp) : $stamp);
}

/**
 *  timestamp()
 *  Return a unix timestamp equivalent of a provided php date
 *  + Stamp is required and will accept unix timestamp or php strtotime() argument
 *  
 *  @param  string  $stamp
 *  @return int
 */
function timestamp($stamp = null)
{
    return preg_match("/^([0-9]+)$/", $stamp ?: time())
        ? $stamp ?: time()
        : strtotime($stamp);
}

/**
 *  timezone()
 *  Return the most user applicable timezone if possible, or default to alternate
 *
 *  @return string
 */
function timezone()
{
    return Auth::check() && Auth::user()->timezone && Auth::user()->timezone !== ''
        ? Auth::user()->timezone
        : config('app.timezone');
}

/**
 *  timezone_offset()
 *  Return the +/- UTC offset integer of the provided (or default) timezone
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
 *  timezone_offset_inverted()
 *  Return the +/- UTC offset integer of the provided (or default) timezone
 *
 *  @param  string  $timezone = null
 *  @return string
 */
function timezone_offset_inverted($timezone = null)
{
    $timezone = new \DateTimeZone(!empty($timezone) ? $timezone : timezone());
    $datetime = new \DateTime("now", $timezone);

    return sprintf("%+d", ($datetime->getOffset() /60 /60) *-1);
}
