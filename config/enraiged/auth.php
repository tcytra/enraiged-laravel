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
    | The default value is false.
    |
    */

    'allow_registration' => (bool) env('ALLOW_REGISTER', false),

    /*
    |--------------------------------------------------------------------------
    | Allow Secondary Credential
    |--------------------------------------------------------------------------
    | 
    | You may allow or disallow a secondary login credential by providing a
    | boolean true or false for 'allow_secondary_credential'. By default, the
    | second credential must be an email address unless 'allow_username_login'
    | is also set to true.
    |
    | The default value is false.
    |
    */

    'allow_secondary_credential' => (bool) env('ALLOW_SECONDARY', false),

    /*
    |--------------------------------------------------------------------------
    | Allow Secondary Credential
    |--------------------------------------------------------------------------
    | 
    | You may allow or disallow the use of a unique username or another email
    | address as the secondary login credential by providing a boolean true or
    | false for 'allow_username_login'.
    | 
    | This option requires 'allow_secondary_credential' to be set to true.
    |
    | The default value is false.
    |
    */

    'allow_username_login' => (bool) env('ALLOW_USERNAME', false),

    /*
    |--------------------------------------------------------------------------
    | Automatic Post-Registration Login
    |--------------------------------------------------------------------------
    | 
    | You may allow or disallow automatic post-registration login by providing
    | a boolean true or false for 'automated_logins'. Please note that if other
    | options such as 'must_agree_to_terms' or 'must_complete_account' are
    | enabled, the login will complete, but the user will be directed to the
    | systems that enforce these policies.
    |
    | The default value is false.
    |
    */

    'automated_login' => (bool) env('AUTO_LOGIN', false),

    /*
    |--------------------------------------------------------------------------
    | Force Lowest Role
    |--------------------------------------------------------------------------
    | 
    | You may choose to enforce a policy that all accounts must have a role. If
    | you switch a production host from false to true, be aware that you will
    | need to assign a role to accounts to make them visible in the indexing.
    |
    | The default value is true.
    |
    */

    'force_lowest_role' => (bool) env('FORCE_ROLE', true),

    /*
    |--------------------------------------------------------------------------
    | Must Verify Email
    |--------------------------------------------------------------------------
    |
    | You may choose to enforce a policy that newly registered accounts must
    | verify their email address before being permitted authenticated access to
    | their account.
    |
    | The default value is false.
    |
    */

    'must_verify_email' => (bool) env('MUST_VERIFY_EMAIL', false),

    /*
    |--------------------------------------------------------------------------
    | Track Ip Addresses
    |--------------------------------------------------------------------------
    |
    | You may choose to store internet protocol addresses that users perform a
    | login from, which in turn will trigger an event you may leverage for your
    | application, such as sending a notification to the end user.
    |
    | The default value is false.
    |
    */

    'track_ip_addresses' => (bool) env('TRACK_IPS', false),

];
