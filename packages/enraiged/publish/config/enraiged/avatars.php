<?php

return [

    /*
    | The fully namespaced model name for the avatars system.
    */
    'model' => Enraiged\Avatars\Models\Avatar::class,

    'color' => [

        /*
        | The default avatar color can be any hexidecimal value between 0 and
        | 0xFFFFFF, or 'random'.
        | 
        | Todo: Unused (Do something with this or get rid of it)
        */
        'default' => 'random',

        /*
        | The minimum and maximum avatar color can be any hexidecimal values
        | applied to the random color logic.
        |
        | Todo: Incomplete
        */
        'maximum' => 0xABCDEF,
        'minimum' => 0,

    ],

    /*
    | The directory name under ~/storage/app/ for storing uploaded avatar image
    | files. This directory will be created if it does not exist.
    */
    'storage' => 'avatars',

];
