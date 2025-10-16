<?php

return [

    'main' => [

        'items' => [
            'dashboard' => [
                //'key' => '0',
                'icon' => 'pi pi-home',
                'label' => 'Dashboard',
                'route' => 'dashboard',
            ],
            'administration' => [
                //'key' => '1',
                'items' => [
                    'roles' => [
                        //'key' => '1_0',
                        'icon' => 'pi pi-key',
                        'label' => 'Manage Roles',
                        'route' => [
                            'match' => 'roles.*',
                            'name' => 'roles.index',
                        ],
                    ],
                    'users' => [
                        //'key' => '1_1',
                        'icon' => 'pi pi-users',
                        'label' => 'Manage Users',
                        'route' => [
                            'match' => 'users.*',
                            'name' => 'users.index',
                        ],
                    ],
                ],
                'label' => 'Administration',
            ],
        ],

        'static' => true,

    ],

];
