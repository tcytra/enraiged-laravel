<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Auth Navigation Options
    |--------------------------------------------------------------------------
    |
    | You may choose to display the auth navigation options in one of two ways:
    |
    | 'panel': The options may be displayed within a full size page panel
    |
    | 'select': The options may be displayed within a select-style dropdown
    |
    | The default value is 'panel' (display the auth options within a panel).
    |
    */
    'auth' => env('AUTH_NAVIGATION_OPTIONS', 'panel'),

    /*
    |--------------------------------------------------------------------------
    | Show Utility Logout
    |--------------------------------------------------------------------------
    |
    | You may choose to show/hide a top-level logout action in the utility bar:
    |
    | The default value is false (do not show a top-level logout action)
    |
    */
    'logout' => env('SHOW_UTILITY_LOGOUT', false),

    /*
    |--------------------------------------------------------------------------
    | Show Mode Selector
    |--------------------------------------------------------------------------
    |
    | You may choose to show/hide the toggle for the light/dark mode selector.
    |
    | The default value is true (show the selector)
    |
    */
    'mode' => env('SHOW_MODE_SELECTOR', true),

    /*
    |--------------------------------------------------------------------------
    | Navigation Panel Structure
    |--------------------------------------------------------------------------
    |
    | You may choose to structure your navigation panels in one of two ways:
    |
    | 'over': The navigation panels will be dominant over the utility bar
    |
    | 'under': The utility bar will be dominant over the navigation panels
    |
    | The default value is 'over' (navigation panels will be dominant)
    |
    */
    'nav' => env('NAV_PANEL_STRUCTURE', 'over'),

    /*
    |--------------------------------------------------------------------------
    | Show Palette Selector
    |--------------------------------------------------------------------------
    |
    | You may choose to show/hide the toggle for the theme palette selector.
    |
    | The default value is true (show the selector)
    |
    */
    'palette' => env('SHOW_PALETTE_SELECTOR', true),

];
