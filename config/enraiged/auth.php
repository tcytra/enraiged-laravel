<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Allow User Login
    |--------------------------------------------------------------------------
    |
    | You may allow or disallow user login by providing a boolean
    | true or false for 'allow_login'.
    |
    | The default value is true (allow logins).
    |
    */

    'allow_login' => (bool) env('ALLOW_LOGIN', true),

    /*
    |--------------------------------------------------------------------------
    | Allow Password Reset
    |--------------------------------------------------------------------------
    |
    | You may allow or disallow user password reset by providing a boolean
    | true or false for 'allow_password_reset'.
    |
    | This option does not affect whether or not a user can update their
    | password through their profile management interface after login.
    |
    | The default value is true (allow password resets).
    |
    */

    'allow_password_reset' => (bool) env('ALLOW_PASSWORD_RESET', true),

    /*
    |--------------------------------------------------------------------------
    | Allow User Registration
    |--------------------------------------------------------------------------
    |
    | You may allow or disallow user registration by providing a boolean
    | true or false for 'allow_registration'.
    |
    | This option does not affect whether or not a user can be created from
    | within the application after login.
    |
    | The default value is false (deny registration).
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
    | The default value is true (allow self delete).
    |
    */

    'allow_self_delete' => (bool) env('ALLOW_DELETE', true),

    /*
    |--------------------------------------------------------------------------
    | Allow Username Login
    |--------------------------------------------------------------------------
    | 
    | You may allow or disallow the use of a unique username as the secondary 
    | login credential by providing a boolean true or false for 
    | 'allow_username_login'.
    | 
    | This option requires 'allow_secondary_credential' to be set to true.
    |
    | The default value is false.
    |
    */

    'allow_username_login' => (bool) env('ALLOW_USERNAME', false),

    /*
    |--------------------------------------------------------------------------
    | Force Guest Login
    |--------------------------------------------------------------------------
    |
    | The application may be configured to redirect all requests to '/' to the
    | login page.
    | 
    | The default value is false (no forced redirect to the login screen).
    |
    */

    'force_guest_login' => (bool) env('FORCE_GUEST_LOGIN', false),

    /*
    |--------------------------------------------------------------------------
    | Must Verify Email
    |--------------------------------------------------------------------------
    |
    | You may choose to enforce a policy that newly registered users must
    | verify their email address before being permitted authenticated access to
    | their account.
    |
    | Important: In the default Enraiged setup the 'auth.providers.users.model'
    | will identify the \App\Models\VerifiedUser class as the default
    | Authenticatable model if the .env file argues MUST_VERIFY_EMAIL=true.
    |
    | This is an attempt to 'automate' the switch between User and VerifiedUser
    | models based on the environment setup, but might not be an ideal way to
    | implement this. This does work but you may consider this unreliable.
    |
    | The better solution is to set the value here and remove the conditional
    | 'auth.providers.users.model' setting in config/auth.php to point to the
    | Authenticatable model appropriate for your project, as per Laravel docs.
    |
    | The default value is false (no email verification required).
    |
    */

    'must_verify_email' => (bool) env('MUST_VERIFY_EMAIL', false),

    /*
    |--------------------------------------------------------------------------
    | Must Verify Secondary
    |--------------------------------------------------------------------------
    |
    | The application may be configured to enforce a policy of verifying the
    | secondary email address the same way the primary login email is verified.
    |
    | If this setting is enabled a user may provide a secondary email address
    | for login (if 'allow_secondary_credential' is also enabled) but will be
    | unable to login with the secondary email address until it is verified.
    |
    | Note: An unverified secondary email address does not disallow logins
    | with the primary email address. Users may trigger a resend of the
    | verification notification from within their profile.
    |
    | It is highly recommended to enable this option if the application is
    | configured to verify the primary email address.
    |
    | The default value is false (no secondary email verification required).
    |
    */

    'must_verify_secondary' => (bool) env('MUST_VERIFY_SECONDARY', false),

    /*
    |--------------------------------------------------------------------------
    | Reject Unverified Secondary
    |--------------------------------------------------------------------------
    |
    | The application may be configured to behave in one of two ways when a
    | successful login has been attempted with an unverified secondary email
    | address.
    |
    | Note: This configuration option has no effect unless both the
    | 'allow_secondary_credential' and 'must_verify_secondary' options are set
    | to true. It is also required that the secondary credential be a valid
    | email address (ie: this setting will have no effect on unique usernames).
    |
    | In keeping with standard Laravel behavior, the default setting (false)
    | will allow a login with an unverified secondary email address but will
    | redirect all authenticated requests to a Verify Secondary Email page.
    |
    | Alternatively, enabling this option (true) will reject the login with
    | an unverified secondary address and display an error on the login page
    | as though the credentials were invalid. In this case, an email will be
    | sent to the secondary address so the user understands why the login was
    | rejected.
    |
    | In either case, this setting does not affect the user's ability to log in
    | with their primary email address.
    |
    | The default value is false (do not reject unverified secondary logins).
    |
    */

    'reject_unverified_secondary' => (bool) env('REJECT_UNVERIFIED_SECONDARY', false),

    /*
    |--------------------------------------------------------------------------
    | Send Login Change Notification
    |--------------------------------------------------------------------------
    |
    | The application may be configured to send a notification to a user when
    | any changes are made to their login credentials.
    |
    | The default value is false (no login change message is sent).
    |
    */

    'send_login_change_notification' => (bool) env('SEND_LOGIN_CHANGE', false),

    /*
    |--------------------------------------------------------------------------
    | Send Welcome Notification
    |--------------------------------------------------------------------------
    |
    | The application may be configured to send a welcome notification to a
    | user when their account is created.
    |
    | If the 'must_verify_email' option is set to true, the welcome email will
    | be sent when the email address has been successfully verified, otherwise
    | it will be sent when the account is created.
    |
    | The default value is false (no welcome message is sent).
    |
    */

    'send_welcome_notification' => (bool) env('SEND_WELCOME', false),

];
