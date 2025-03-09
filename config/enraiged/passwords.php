<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Current Password Restriction
    |--------------------------------------------------------------------------
    |
    | You may enable or disable storing the current user password if provided
    | in a request by providing a boolean true|false.
    |
    | If set true, the application will deny sending the current password to
    | store as a new password.
    |
    | The default value is false (no current password restriction).
    |
    */

    'current' => env('PASSWORD_CURRENT', false),

    /*
    |--------------------------------------------------------------------------
    | Password History Restriction
    |--------------------------------------------------------------------------
    |
    | You may enable or disable password history restrictions for this
    | application by providing a boolean true|false. 
    |
    | Enabling password history requirement with a value of true will disallow
    | a user from using just the one previous password in their history.
    |
    | Providing a value of 0 will disallow a user from using any of the
    | previous passwords in their history.
    |
    | Providing any other integer value will only enforce the requirement up to
    | that many password changes back in the user's history.
    |
    | The default value is false (no password history restrictions).
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
    | This option will accept an integer as a provided value.
    |
    | The default value is 8 (the password must be a minimum of 8 characters).
    |
    */

    'length' => env('PASSWORD_LENGTH', 8),

    /*
    |--------------------------------------------------------------------------
    | Password Lowercase Characater Requirement
    |--------------------------------------------------------------------------
    |
    | This will enforce a minimum number of lowercase characters for user
    | passwords.
    |
    | This option will accept an integer or true|false as a provided value.
    |
    | If set true, the password will require at least 1 lowercase character, 
    | otherwise the integer value will be enforced as the minimum number.
    |
    | The default value is false (no lowercase character restriction).
    |
    */

    'lowercase' => env('PASSWORD_LOWERCASE', false),

    /*
    |--------------------------------------------------------------------------
    | Password Numeric Characater Requirement
    |--------------------------------------------------------------------------
    |
    | This will enforce a minimum number of numeric characters for user
    | passwords.
    |
    | This option will accept an integer or true|false as a provided value.
    |
    | If set true, the password will require at least 1 numeric character, 
    | otherwise the integer value will be enforced as the minimum number.
    |
    | The default value is false (no numeric character restriction).
    |
    */

    'numeric' => env('PASSWORD_NUMERIC', false),

    /*
    |--------------------------------------------------------------------------
    | Password Special Characater Requirement
    |--------------------------------------------------------------------------
    |
    | This will enforce a minimum number of special (non-alphanumerical)
    | characters for user passwords.
    |
    | This option will accept an integer or true|false as a provided value.
    |
    | If set true, the password will require at least 1 special character, 
    | otherwise the integer value will be enforced as the minimum number.
    |
    | The default value is false (no special character restriction).
    |
    */

    'special' => env('PASSWORD_SPECIAL', false),

    /*
    |--------------------------------------------------------------------------
    | Password Uppercase Characater Requirement
    |--------------------------------------------------------------------------
    |
    | This will enforce a minimum number of lowercase characters for user
    | passwords.
    |
    | This option will accept an integer or true|false as a provided value.
    |
    | If set true, the password will require at least 1 uppercase character, 
    | otherwise the integer value will be enforced as the minimum number.
    |
    | The default value is false (no uppercase character restriction).
    |
    */

    'uppercase' => env('PASSWORD_UPPERCASE', false),

];
