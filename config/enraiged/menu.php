<?php

return [

    [
        'icon' => 'pi pi-home',
        'route' => '/',
        'secure' => [
            'method' => 'isGuest',
        ],
    ],

    'Dashboard' => [
        'icon' => 'pi pi-home',
        'route' => '/dashboard',
        'secure' => [
            'method' => 'isAuth',
        ],
    ],

    'Manage Users' => [
        'icon' => 'pi pi-users',
        'route' => '/users',
        'secure' => [
            'method' => 'roleIs',
            'role' => 'Administrator',
        ],
    ],

];
