<?php

return [

    'Dashboard' => [
        'icon' => 'pi pi-home',
        'route' => '/',
    ],

    'Accounts' => [
        'icon' => 'pi pi-users',
        'route' => '/accounts',
        'secure' => [
            'method' => 'roleIs',
            'role' => 'Administrator',
        ],
    ],

];
