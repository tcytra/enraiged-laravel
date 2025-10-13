<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Set Default Mode
    |--------------------------------------------------------------------------
    |
    | Set the default ui visual mode.
    |
    | The available options are 'light' and 'dark'.
    |
    | The default value is 'light'.
    |
    */
    'mode' => env('VISUAL_MODE', 'light'),

    /*
    |--------------------------------------------------------------------------
    | Set Primary Color
    |--------------------------------------------------------------------------
    |
    | Set the default ui primary color.
    |
    | The available options are 'slate', 'noir', 'emerald', 'green', 'lime',
    | 'orange', 'amber', 'yellow', 'teal', 'cyan', 'sky', 'blue', 'indigo',
    | 'violet', 'purple', 'fuchsia', 'pink', and 'rose'
    |
    | The default value is 'slate'.
    |
    */
    'primary' => env('PRIMARY_COLOR', 'slate'),
    
    /*
    |--------------------------------------------------------------------------
    | Set Palette Color
    |--------------------------------------------------------------------------
    |
    | Set the default ui color palette.
    |
    | The available options are 'slate', 'noir'. 'zinc', 'neutral', 'stone',
    | 'soho', 'viva', and 'ocean'.
    |
    | The default value is 'slate'.
    |
    */
    'surface' => env('PALETTE_COLOR', 'slate'),

];
