<?php

return [

    'formats' => [
        'currency' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD,
        'date' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD,
        'hours' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_00,
        'number' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER,
    ],

    'storage' => 'exports',

    'template' => [

        'actions' => [
        ],

        'class' => 'p-datatable-sm',

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
