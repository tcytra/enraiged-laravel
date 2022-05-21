<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Allow Account Registration
    |--------------------------------------------------------------------------
    | 
    | You may allow or disallow account registration by providing a boolean
    | true or false for 'allow_registration'.
    |
    */

    'allow_registration' => (bool) env('ALLOW_REGISTER', true),

    /*
    |--------------------------------------------------------------------------
    | Automatic Post-Registration Login
    |--------------------------------------------------------------------------
    | 
    | You may allow or disallow automatic post-registration login by providing
    | a boolean true or false for 'automated_logins'.
    |
    */

    'automated_login' => (bool) env('AUTO_LOGIN', true),

    /*
    |--------------------------------------------------------------------------
    | Force Lowest Role
    |--------------------------------------------------------------------------
    | 
    | You may choose to enforce a policy that all accounts must have a role. If
    | you switch a production host from false to true, be aware that you will
    | need to assign a role to accounts to make them visible in the indexing.
    |
    */

    'force_lowest_role' => (bool) env('FORCE_ROLE', true),

];
