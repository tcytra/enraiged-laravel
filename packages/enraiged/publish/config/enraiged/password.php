<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password History Requirement
    |--------------------------------------------------------------------------
    |
    | You may enable or disable password history requirements for this
    | application by providing a boolean true|false. 
    |
    | Turning on password history requirement with a value of true will
    | disallow a user from using any previous passwords in their history.
    |
    | You may also provide an integer value that will only enforce the
    | requirement up to that many password changes back in the user's history.
    |
    | The default value is false.
    |
    */

    'history' => env('PASSWORD_HISTORY', false),

    /*
    |--------------------------------------------------------------------------
    | Password Length Requirement
    |--------------------------------------------------------------------------
    |
    | This will enforce a minimum character requirement for user passwords.
    | 
    | The default value is 6.
    |
    */

    'length' => env('PASSWORD_LENGTH', 6),

    /*
    |--------------------------------------------------------------------------
    | Password Lowercase Characater Requirement
    |--------------------------------------------------------------------------
    |
    | This will enforce a minimum number of lowercase characters for user
    | passwords.
    | 
    | The default value is 6.
    |
    */

    'lowercase' => env('PASSWORD_LOWERCASE', 0),

    /*
    |--------------------------------------------------------------------------
    | Password Numeric Characater Requirement
    |--------------------------------------------------------------------------
    |
    | This will enforce a minimum number of numeric characters for user
    | passwords.
    | 
    | The default value is 1.
    |
    */

    'numeric' => env('PASSWORD_NUMERIC', 1),

    /*
    |--------------------------------------------------------------------------
    | Password Special Characater Requirement
    |--------------------------------------------------------------------------
    |
    | This will enforce a minimum number of special (non-alphanumerical)
    | characters for user passwords.
    | 
    | The default value is 1.
    |
    */

    'special' => env('PASSWORD_SPECIAL', 1),

    /*
    |--------------------------------------------------------------------------
    | Password Uppercase Characater Requirement
    |--------------------------------------------------------------------------
    |
    | This will enforce a minimum number of lowercase characters for user
    | passwords.
    | 
    | The default value is 6.
    |
    */

    'uppercase' => env('PASSWORD_UPPERCASE', 1),

];
