<?php

return [

    'items' => [
        'dashboard' => [
            'icon' => 'pi pi-home',
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'secure' => ['method' => 'isAuth'],
        ],
        'administration' => [
            'label' => 'Administration',
            'items' => [
                'users' => [
                    'icon' => 'pi pi-users',
                    'label' => 'Manage Users',
                    'route' => [
                        'match' => 'users.*',
                        'name' => 'users.index',
                    ],
                ],
            ],
            'secure' => ['method' => 'isAdministrator'],
        ],

    ],

    'static' => true,

    'source' => 'config',

];
