<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Absolute Uris
    |--------------------------------------------------------------------------
    | 
    | Define whether or not generated routes use absolute uri paths.
    |
    */

    'absolute_uris' => env('ABSOLUTE_URIS', true),

    /*
    |--------------------------------------------------------------------------
    | Country Code
    |--------------------------------------------------------------------------
    | 
    | Define a default ISO 3166-1 alpha-2 country code.
    |
    */

    'country_code' => env('COUNTRY_CODE', 'CA'),

    /*
    |--------------------------------------------------------------------------
    | Timezone
    |--------------------------------------------------------------------------
    | 
    | Define a default timezone by database name or ISO 8601 offset designator.
    |
    */
    
    'timezone' => env('TIMEZONE', 'America/Vancouver'),

];
