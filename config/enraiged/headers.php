<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Certificate Transparency
    |--------------------------------------------------------------------------
    |
    | The default value is 'enforce, max-age=30'.
    |
    */
    'certificate-transparency' => 'enforce, max-age=30',

    /*
    |--------------------------------------------------------------------------
    | Content Security Policy
    |--------------------------------------------------------------------------
    |
    | The default value is "default-src 'self'; connect-src *; \
    |   script-src 'self'; img-src 'self' data:; \
    |   style-src 'self' 'unsafe-inline'; font-src 'self'; child-src 'self'; \
    |   object-src 'none'; frame-ancestors 'none'".
    |
    */
    'content-security-policy' => "default-src 'self'; connect-src *; script-src 'self' 'nonce-:nonce'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; font-src 'self'; child-src 'self'; object-src 'none'; frame-ancestors 'none'",

    /*
    |--------------------------------------------------------------------------
    | Remove Headers
    |--------------------------------------------------------------------------
    |
    | The default value is ['X-Powered-By','x-powered-by','Server','server'].
    |
    */
    'remove' => [
        'X-Powered-By',
        'x-powered-by',
        'Server',
        'server',
    ],

    /*
    |--------------------------------------------------------------------------
    | Referrer Policy
    |--------------------------------------------------------------------------
    |
    | The default value is 'same-origin'.
    |
    */
    'referrer-policy' => 'same-origin',

    /*
    |--------------------------------------------------------------------------
    | Strict Transport Security
    |--------------------------------------------------------------------------
    |
    | The default value is 'max-age=31536000; includeSubdomains'.
    |
    */
    'strict-transport-security' => 'max-age=31536000; includeSubdomains',

    /*
    |--------------------------------------------------------------------------
    | Permissions Policy
    |--------------------------------------------------------------------------
    |
    | The default value is 'autoplay=(self), camera=(), \
    |   encrypted-media=(self), fullscreen=(), geolocation=(self), \
    |   gyroscope=(self), magnetometer=(), microphone=(), midi=(), \
    |   payment=(), sync-xhr=(self), usb=()'
    |
    */
    'permissions-policy' => 'autoplay=(self), camera=(), encrypted-media=(self), fullscreen=(), geolocation=(self), gyroscope=(self), magnetometer=(), microphone=(), midi=(), payment=(), sync-xhr=(self), usb=()',

    /*
    |--------------------------------------------------------------------------
    | X Content-Type Options
    |--------------------------------------------------------------------------
    |
    | The default value is 'nosniff'.
    |
    */
    'x-content-type-options' => 'nosniff',

    /*
    |--------------------------------------------------------------------------
    | X Frame Options
    |--------------------------------------------------------------------------
    |
    | The default value is 'SAMEORIGIN'.
    |
    */
    'x-frame-options' => 'SAMEORIGIN',

    /*
    |--------------------------------------------------------------------------
    | X Permitted Cross Domain Policies
    |--------------------------------------------------------------------------
    |
    | The default value is 'none'.
    |
    */
    'x-permitted-cross-domain-policies' => 'none',

    /*
    |--------------------------------------------------------------------------
    | X XSS-Protection
    |--------------------------------------------------------------------------
    |
    | The default value is '1; mode=block'.
    |
    */
    'x-xss-protection' => '1; mode=block',

];
