<?php

return [

    'absolute_uris' => config('enraiged.app.absolute_uris', true),

    'class' => 'vertical',

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
            'store' => [
                'label' => 'Save',
            ],
            'update' => [
                'label' => 'Update',
            ],
        ],

        'fields' => [],

    ],

];
