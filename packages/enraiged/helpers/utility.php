<?php

use Symfony\Component\Debug\Exception\FatalThrowableError; // deprecated?

if (!function_exists('blade')) {
    /**
     *  Render a string into a blade template with parameters.
     *
     *  @param  string  $template
     *  @param  array   $parameters = []
     *  @return string;
     */
    function blade($template, $parameters = [])
    {
        $ob = ob_get_level();
        ob_start();

        extract($parameters, EXTR_SKIP);

        try {
            eval('?' . '>' . $template);
        } catch (Exception $e) {
            while (ob_get_level() > $ob) ob_end_clean();
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $ob) ob_end_clean();
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
