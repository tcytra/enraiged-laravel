<?php

use Enraiged\Agreements\Models\Agreement;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

/**
 *  Return the configured users auth model.
 *
 *  @return \Illuminate\Foundation\Auth\User
 */
function auth_model()
{
    $provider = config('auth.guards.web.provider');
    $model = config("auth.providers.{$provider}.model");

    return $model;
}

/**
 *  Determine if the argued user is an instance of Authenticatable.
 *
 *  @param  \Illuminate\Foundation\Auth\User  $user
 *  @return bool
 *
 *  @throws \Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException
 */
function authenticable_check($user)
{
    if (!$user instanceof Authenticatable) {
        throw new PreconditionFailedHttpException(
            __(':method Argument must be an instance of :instance', [
                'method' => 'Enraiged\\Auth\\User::canImpersonate():',
                'instance' => 'Illuminate\\Foundation\\Auth\\User',
            ])
        );
    }
}

if (!function_exists('language')) {
    /**
     *  Return the appropriate user or app language (locale).
     *
     *  @return string
     */
    function language()
    {
        return Auth::check() && Auth::user()->language
            ? Auth::user()->language
            : config('app.locale');
    }
}

/**
 *  Handle an authenticated user logout.
 */
function logout($request = null)
{
    if (Auth::check()) {
        $request = $request ?: request();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return true;
    }

    return false;
}

/**
 *  Determine whether or not terms agreements are required.
 *
 *  @return bool
 */
function require_agreement(): bool
{
    static $require_agreement;

    if (is_null($require_agreement)) {
        $require_agreement = Agreement::required()->count() > 0;
    }

    return $require_agreement;
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
 *  Return the current authenticated user model.
 *  
 *  @param  string|null  $guard
 *  @return mixed
 */
function user($guard = null)
{
    return Auth::guard($guard)->user();
}
