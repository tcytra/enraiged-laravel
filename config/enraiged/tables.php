<?php

return [

    'full_urls' => true,

    'storage' => 'exports',

    'template' => [

        'actions' => [
            'show' => [
                'class' => 'p-btn-primary',
                'icon' => 'pi pi-eye',
                'method' => 'emit',
                'tooltip' => 'Show',
            ],
            'edit' => [
                'class' => 'p-button-warning',
                'icon' => 'pi pi-pencil',
                'method' => 'emit',
                'tooltip' => 'Edit',
            ],
            'destroy' => [
                'class' => 'p-button-danger',
                'confirm' => 'Are you certain?',
                'icon' => 'pi pi-trash',
                'method' => 'delete',
                'tooltip' => 'Delete',
            ],
        ],

        'columns' => [
            'id' => [
                'label' => 'ID',
            ],
            'created_at' => [
                'class' => 'text-right',
                'label' => 'Created',
                'sortable' => true,
            ],
        ],

        'key' => 'id',

        'pagination' => [
            'options' => [10, 25, 50, 100],
            'page' => 1,
            'rows' => 10,
        ],

    ],

];
