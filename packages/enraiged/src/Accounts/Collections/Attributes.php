<?php

namespace Enraiged\Accounts\Collections;

use Enraiged\Support\Collections\Fillable;

class Attributes
{
    use Fillable;

    static $fillable = [
        'email', 'password', 'timezone', 'username',
    ];
}
