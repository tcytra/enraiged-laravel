<?php

return [

    'items' => [
        'dashboard' => [
            'icon' => 'pi pi-home',
            'label' => 'Dashboard',
            'route' => 'dashboard',
        ],
        'administration' => [
            'label' => 'Administration',
            'items' => [
                'roles' => [
                    'icon' => 'pi pi-key',
                    'label' => 'Manage Permissions',
                    'route' => [
                        'match' => 'permissions.*',
                        'name' => 'permissions.index',
                    ],
                ],
                'users' => [
                    'icon' => 'pi pi-users',
                    'label' => 'Manage Users',
                    'route' => [
                        'match' => 'users.*',
                        'name' => 'users.index',
                    ],
                ],
            ],
        ],

    ],

    'static' => true,

    'source' => 'config',

];
