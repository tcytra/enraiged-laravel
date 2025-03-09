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

];
