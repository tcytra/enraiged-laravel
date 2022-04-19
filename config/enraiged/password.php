<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Complexity Requirements
    |--------------------------------------------------------------------------
    | 
    | Provide a numerical value or a boolean false to enforce a requirement
    | 
    */

    'history' => false,

    'length' => env('PASSWORD_LENGTH', 6),

    'lowercase' => env('PASSWORD_LOWERCASE', 0),

    'numeric' => env('PASSWORD_NUMERIC', 0),

    'special' => env('PASSWORD_SPECIAL', 0),

    'uppercase' => env('PASSWORD_UPPERCASE', 0),

];
