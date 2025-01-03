<?php

return [

    'absolute_uris' => config('enraiged.app.absolute_uris', true),

    'formats' => [
        'currency' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_00,
        'date' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD,
    ],

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

        'class' => 'p-datatable-sm shadow-1',

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

        'empty' => 'There are no records to display.',

        'key' => 'id',

        'pagination' => [
            'options' => [10, 25, 50, 100],
            'page' => 1,
            'rows' => 10,
        ],

        'selectable' => false,

        'state' => false,

    ],

];
