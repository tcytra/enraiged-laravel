<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Allow Impersonation
    |--------------------------------------------------------------------------
    |
    | You may allow or disallow the ability for certain roles to impersonate 
    | users by providing a boolean true or false for 'allow_impersonation'.
    |
    | The default value is true and will default to allow the Administrator
    | role as defined in 'administrator_role' above to impersonate anyone but
    | another Administrator.
    |
    | More sophisticated application of this feature can be achieved by using
    | the 'except_roles' or 'only_roles' definitions to select which roles are
    | permitted to impersonate other users.
    |
    | Example:
    |
    | 'allow_impersonation' => [
    |     'only_roles' => ['Administrator', 'Vendor'],
    | ],
    |
    | You may allow or disallow the ability to impersonate an Administrator by
    | providing a boolean value for 'impersonate_administrator'.
    |
    | The default value for 'impersonate_administrator' is false, this must be
    | explicitly enabled in the configuration.
    |
    | You may allow or disallow the ability to impersonate a higher ranking
    | role by providing a boolean value for 'elevated_roles'.
    |
    | The default value for 'elevated_roles' is false, this must be explicitly
    | enabled in the configuration.
    |
    */

    'allow_impersonation' => true,

    /*
    |--------------------------------------------------------------------------
    | Allow Profile Name Change
    |--------------------------------------------------------------------------
    |
    | You may allow or disallow the ability for a profile user to change
    | their name by providing a boolean true or false for 'allow_name_change'.
    |
    | The default value is true.
    |
    | More sophisticated application of this feature can be achieved by using
    | the 'except_roles' or 'only_roles' definitions to select which roles are
    | permitted to update their name. Single-item strings or multi-item arrays
    | of role names can be provided as values.
    |
    | Example:
    |
    | 'allow_name_change' => [
    |     'except_roles' => 'Member',
    | ],
    |
    | Alternatively, specify roles in the 'ignore_roles' definition to ignore
    | those roles and apply the next rule to the rest of the users.
    |
    | Provide a value for the 'until_expire' definition to apply a time limit
    | from the creation of a user to allow a name change. This value can be
    | any string accepted by php strtotime().
    |
    | Example:
    |
    | 'allow_name_change' => [
    |     'ignore_roles' => 'Administrator',
    |     'until_expire' => '-30 days',
    | ],
    |
    */

    // 'allow_name_change' => true,

    /*
    |--------------------------------------------------------------------------
    | Allow User Login
    |--------------------------------------------------------------------------
    |
    | You may allow or disallow user login by providing a boolean
    | true or false for 'allow_login'.
    |
    | The default value is true.
    |
    */

    'allow_login' => (bool) env('ALLOW_LOGIN', true),

    /*
    |--------------------------------------------------------------------------
    | Allow User Registration
    |--------------------------------------------------------------------------
    |
    | You may allow or disallow user registration by providing a boolean
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
    | Allow Self Delete
    |--------------------------------------------------------------------------
    |
    | You may allow or disallow users to delete their own accounts.
    |
    | The default value is false.
    |
    */

    'allow_self_delete' => (bool) env('ALLOW_DELETE', false),

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
    | a boolean true or false for 'automated_logins'.
    |
    | Please note:
    |
    | If 'must_verify_email' is enabled, this setting will be ignored.
    |
    | If 'must_verify_email' or 'must_complete_profile' are enabled, the login
    | will complete but the user may be redirected to the systems that enforce
    | these policies.
    |
    | The default value is false.
    |
    */

    'automated_login' => (bool) env('AUTO_LOGIN', false),

    /*
    |--------------------------------------------------------------------------
    | Force Default Role
    |--------------------------------------------------------------------------
    |
    | You may choose to enforce a policy that all users will default to a
    | specified role if no role is provided when the user is created. This
    | value will take priority over the 'force_lowest_role' configuration.
    |
    | The default value is 'Member'.
    |
    | Remove this and the 'force_lowest_role' config if you want to allow
    | registering users without a role. This is however not recommended as it
    | will cause the app to malfunction.
    |
    */

    'force_default_role' => (string) env('FORCE_DEFAULT_ROLE', 'Member'),

    /*
    |--------------------------------------------------------------------------
    | Force Lowest Role
    |--------------------------------------------------------------------------
    |
    | You may choose to enforce a policy that all users will default to the
    | lowest ranked role if no role is provided when the user is created. This
    | value is secondary to the 'force_default_role' configuration.
    |
    | The default value is true.
    |
    | Remove this and the 'force_default_role' config if you want to allow
    | registering users without a role. This is however not recommended as it
    | will cause the app to malfunction.
    |
    */

    'force_lowest_role' => (bool) env('FORCE_LOWEST_ROLE', true),

    /*
    |--------------------------------------------------------------------------
    | Must Agree To Terms
    |--------------------------------------------------------------------------
    |
    | You may force application users to agree to terms by providing a boolean
    | true or false for 'must_agree_to_terms'.
    |
    | Setting this option true or false will enable or disable the ability to
    | require agreement to any required terms.
    |
    | If true, all agreement types will be considered required by default.
    |
    | The default value is false.
    |
    | More sophisticated application of this feature can be achieved by using
    | the 'except_roles' or 'only_roles' definitions to select which roles are
    | required to agree. Single-item strings or multi-item arrays of role names
    | can be provided as values.
    |
    | By default, all published agreement types are required for the matching
    | roles, but the required agreements could also be defined by type using
    | the 'required_terms' definition. Single-item strings or multi-item arrays
    | of agreement types can be provided as values.
    |
    | Finally, the project may implement an 'eager-' or 'lazy-agreement'
    | strategy of enforcing agreement requirement. If a definition exists for
    | 'automatic_agreements', and if this definition is set true, an agreement
    | history will be automatically created when a user is created. If this
    | definition does not exist, or if it is set false, no automated agreements
    | will occur.
    |
    | A working example could look like this:
    |
    | 'must_agree_to_terms' => [
    |
    |   //  implement automated 'lazy-agreement' strategy
    |   'automatic_agreements' => true,
    |
    |   //  exempt higher roles from this requirement
    |   'except_roles' => ['Administrator', 'Vendor'],
    |
    |   //  these agreement types will be required, if published
    |   'required_terms' => ['EULA', 'TOS'],
    |
    | ],
    |
    */

    // 'must_agree_to_terms' => false,

    /*
    |--------------------------------------------------------------------------
    | Must Complete Profile
    |--------------------------------------------------------------------------
    |
    | Not implemented at this time.
    |
    */

    'must_complete_profile' => false,

    /*
    |--------------------------------------------------------------------------
    | Must Verify Email
    |--------------------------------------------------------------------------
    |
    | You may choose to enforce a policy that newly registered users must
    | verify their email address before being permitted authenticated access to
    | their account.
    |
    | The default value is false.
    |
    | Set this value in the .env file to force the auth.providers.users.model
    | config to identify the \Enraiged\Auth\VerifiedUser class as the default
    | User model, which implements the MustVerifyEmail contract.
    |
    */

    'must_verify_email' => (bool) env('MUST_VERIFY_EMAIL', false),

    /*
    |--------------------------------------------------------------------------
    | Send Welcome Notification
    |--------------------------------------------------------------------------
    |
    | The application may be configured to send a welcome notification to a
    | user when their account is created.
    | 
    | The default value is false.
    |
    */

    'send_welcome_notification' => (bool) env('SEND_WELCOME', false),

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
