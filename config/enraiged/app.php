<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Absolute Uris
    |--------------------------------------------------------------------------
    | 
    | Define whether or not generated routes use absolute uri paths.
    |
    | The default value is false (generate relative urls).
    |
    */

    'absolute_uris' => env('ABSOLUTE_URIS', false),

    /*
    |--------------------------------------------------------------------------
    | Mail Markdown
    |--------------------------------------------------------------------------
    | 
    | Whether to form the mail messages via markdown blade templates.
    |
    | The default value is false (generate messages via inline functions).
    |
    */

    'mail_markdown' => env('MAIL_MARKDOWN', false),

    /*
    |--------------------------------------------------------------------------
    | System User
    |--------------------------------------------------------------------------
    | 
    | Provide the email of a user account that will be used for otherwise
    | untracked system operations, such as queued jobs, activity logs, etc.
    |
    | It is recommended to seed this user as hidden and protected to prevent it
    | from being removed or altered,
    |
    | The default value is 'administrator@enraiged.local'.
    |
    */
    'system_user' => env('SYSTEM_USER', 'administrator@enraiged.local'),

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
