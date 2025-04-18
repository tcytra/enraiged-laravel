<?php

return [

    'absolute_uris' => config('enraiged.app.absolute_uris', true),

    'labels' => 'vertical',

    'multipart' => false,

    'template' => [

        'actions' => [
            'back' => [
                'label' => 'Back',
            ],
            'clear' => [
                'label' => 'Clear',
            ],
            'reset' => [
                'label' => 'Reset',
            ],
            'submit' => [
                'label' => 'Submit',
            ],
        ],

        'fields' => [],

    ],

];
