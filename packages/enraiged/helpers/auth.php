<?php

use App\Auth\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('uhash')) {
    /**
     *  Return a formatted alphanumeric hash, optionally based on a provided key.
     *
     *  @param  string  $key = null
     *  @return string
     */
    function uhash($key = null)
    {
        $base = $key ?? substr(time(), -7);
        $post = substr(md5(user()->id), -3);

        return sha1("{$base}-{$post}");
    }
}

/**
 *  user()
 *  Return the current Auth\User object
 *  
 *  @return object
 */
function user()
{
    static $user = null;

    if ($user === null) {
        $user = Auth::check()
            ? Auth::user() ?? Auth::guard('api')->user()
            : new User;
    }

    return $user;
}
