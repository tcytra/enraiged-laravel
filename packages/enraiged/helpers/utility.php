<?php

use Illuminate\Support\Str;
use Symfony\Component\Debug\Exception\FatalThrowableError; // todo: deprecated?

/**
 *  todo: remove this? laravel documents the ability to do this now
 */
if (!function_exists('blade')) {
    /**
     *  Render a string into a blade template with parameters.
     *
     *  @param  string  $template
     *  @param  array   $parameters = []
     *  @return string
     */
    function blade($template, $parameters = [])
    {
        $ob = ob_get_level();
        ob_start();

        extract($parameters, EXTR_SKIP);

        try {
            eval('?' . '>' . $template);
        } catch (Exception $e) {
            while (ob_get_level() > $ob) {
                ob_end_clean();
            }
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $ob) {
                ob_end_clean();
            }
            throw new FatalThrowableError($e);
        }

        return ob_get_clean();
    }
}

if (!function_exists('dollar')) {
    /**
     *  Render a provided value into a dollar format.
     *
     *  @param  mixed   $amount
     *  @param  bool    $comma
     *  @return string
     *  @todo Rewrite as currency() with optional i18n symbol
     */
    function dollar($amount, $comma = true)
    {
        return number_format($amount, 2, '.', ($comma ? ',' : ''));
    }
}

if (!function_exists('get_class_name')) {
    /**
     *  Return only the class name portion of the get_class() function.
     *
     *  @param  object  $class
     *  @return string
     */
    function get_class_name($class)
    {
        $get_class = gettype($class) === 'object'
            ? get_class($class)
            : $class;

        if (gettype($get_class) === 'string') {
            return strtolower( substr($get_class, strrpos($get_class, '\\') +1) );
        }

        return null;
    }
}

if (!function_exists('ip_from_binary')) {
    /**
     *  Convert a binary format to a readable internet protocol address.
     *
     *  @param  string  $address
     *  @return int
     */
    function ip_from_binary($address)
    {
        return inet_ntop($address);
    }
}

if (!function_exists('ip_to_binary')) {
    /**
     *  Convert a binary format to a readable internet protocol address.
     *
     *  @param  string  $address
     *  @return int
     */
    function ip_to_binary($address)
    {
        return inet_pton($address);
    }
}

if (!function_exists('ip_version')) {
    /**
     *  Detect and return the ip version of a provided address.
     *
     *  @param  string  $address
     *  @return int
     */
    function ip_version($address)
    {
        if (filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return 4;
        }

        if (filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return 6;
        }

        return 0; // this should never happen
    }
}

if (!function_exists('message')) {
    /**
     *  Construct and return a message object from the provided parameters.
     *
     *  @param  string  $body
     *  @param  string  $severity = 'info'  Can be 'danger', 'info', or 'warn'.
     *  @param  bool    $closable
     *  @return object
     */
    function message(string $body, string $severity = 'info', bool $closable = true)
    {
        return (object) [
            'body' => __($body),
            'closable' => $closable,
            'severity' => $severity,
        ];
    }
}

if (!function_exists('number')) {
    /**
     *  Render a provided value into a short-form number format.
     *
     *  @param  mixed   $value
     *  @param  bool    $comma
     *  @return string
     */
    function number($value, $comma = true)
    {
        return number_format($value, 0, null, ($comma ? ',' : ''));
    }
}

if (!function_exists('obj')) {
    /**
     *  Convert and return a provided value as an stdClass object.
     *
     *  @param  mixed   $value
     *  @return object
     */
    function obj($value)
    {
        if (gettype($value) === 'string') {
            $value = json_decode($value);
        }

        return json_decode(json_encode($value));
    }
}

if (!function_exists('packages_path')) {
    /**
     *  Get the packages path.
     *
     *  @param  string  $path
     *  @return string
     */
    function packages_path($path = '') {
        return app()->basePath("packages/{$path}");
    }
}

if (!function_exists('phone_format')) {
    /**
     *  Return a provided numeric string as a north american phone number.
     *
     *  @param  string  $number
     *  @return string|null
     */
    function phone_format($number) {
        if (preg_match('/^\d{10,11}$/', preg_replace('/[^\d]/', '', $number))) {
            $line_number = substr($number, -4);
            $phone_prefix = substr($number, -7, -4);
            $area_code = substr($number, -10, -7);
            $country_code = strlen($number) === 11
                ? '+'.substr($number, 0, 1).'-'
                : '';

            return "{$country_code}{$area_code}-{$phone_prefix}-{$line_number}";
        }

        return null;
    }
}

if (!function_exists('resolve_object_path')) {
    /**
     *  Evaluate a dot.notation string against an object to return a callable child object configuration.
     *
     *  @param  string  $value
     *  @param  object  $object
     *  @param  bool    $camel
     *  @return array
     */
    function resolve_object_path($value, $object, $camel = true)
    {
        $pieces = array_reverse(explode('.', $value));
        $call = array_shift($pieces);

        foreach ($pieces as $each) {
            $path = $camel ? Str::camel($each) : $each;

            if ($object->{$path}) {
                $object = $object->{$path};
            }
        }

        return $camel
            ? [Str::camel($call), $object]
            : [$call, $object];
    }
}

if (!function_exists('rgbfromcolorindex')) {
    /**
     *  Return an array containg the RGB values from the provided color index.
     *
     *  @param  int     $index
     *  @return array
     */
    function rgbfromcolorindex($index)
    {
        return preg_match('/^\d+$/', $index)
            ? [($index >> 16) & 0xFF, ($index >> 8) & 0xFF, $index & 0xFF]
            : null;
    }
}

if (!function_exists('set_env')) {
    /**
     *  Set a variable value in the .env file.
     *
     *  @param  string  $index
     *  @param  string  $value
     *  @return void
     */
    function set_env($index, $value)
    {
        $env = app()->environmentFilePath();
        $str = file_get_contents($env);

        $str .= "\n"; // In case the searched variable is in the last line without \n
        $pos = strpos($str, "{$index}=");
        $eol = strpos($str, PHP_EOL, $pos);
        $old = substr($str, $pos, $eol - $pos);
        $str = str_replace($old, "{$index}={$value}", $str);
        $str = substr($str, 0, -1);

        $fp = fopen($env, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
}

if (!function_exists('short_description')) {
    /**
     *  Shorten a text description to a provided number of words.
     *
     *  @param  string  $description
     *  @param  int     $words = 6
     *  @return string
     */
    function short_description(string $description, int $words = 6): string
    {
        //  this is an attempt to strip emojis out of the description
        $converted_data = mb_convert_encoding($description, "UTF-8");
        $new_description = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $converted_data);

        return Str::words($new_description, $words);
    }
}

if (!function_exists('trim_lower')) {
    /**
     *  Strip whitespace (or other characters) and return a lowercase string.
     *
     *  @param  string  $string
     *  @param  string  $characters = ' \n\r\t\v\0'
     *  @return string|null
     */
    function trim_lower(string $string, string $characters = ' \n\r\t\v\0')
    {
        return $string
            ? strtolower(trim($string, $characters))
            : null;
    }
}
