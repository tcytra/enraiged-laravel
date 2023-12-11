<?php

return [

    'internet_address_login' => [
        'channels' => ['mail'],
    ],

    'user_login_change' => [
        'channels' => ['mail'],
    ],

    'welcome_notification' => [
        'channels' => ['mail'],
        'markdown' => 'mail.auth.welcome',
    ],

];
