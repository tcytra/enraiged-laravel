<?php

return [

    'certificate-transparency' => 'enforce, max-age=30',

    'content-security-policy' => "default-src 'self'; connect-src *; script-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; font-src 'self'; child-src 'self'; object-src 'none'; frame-ancestors 'none'",

    'remove' => [
        'X-Powered-By',
        'x-powered-by',
        'Server',
        'server',
    ],

    'referrer-policy' => 'same-origin',

    'strict-transport-security' => 'max-age=31536000; includeSubdomains',

    'permissions-policy' => 'autoplay=(self), camera=(), encrypted-media=(self), fullscreen=(), geolocation=(self), gyroscope=(self), magnetometer=(), microphone=(), midi=(), payment=(), sync-xhr=(self), usb=()',

    'x-content-type-options' => 'nosniff',

    'x-frame-options' => 'SAMEORIGIN',

    'x-permitted-cross-domain-policies' => 'none',

    'x-xss-protection' => '1; mode=block',

];
