<?php

use App\Auth\User;
use Illuminate\Support\Facades\Auth;

/**
 *  Determine whether or not username logins are permitted.
 *
 *  @return bool
 */
function allow_username_login()
{
    return config('enraiged.auth.allow_username_login') === true
        && config('enraiged.auth.allow_secondary_credential') === true;
}

/**
 *  Format an alphanumeric hash, optionally based on a provided key.
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

/**
 *  Return the current authenticated user model, if possible.
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
