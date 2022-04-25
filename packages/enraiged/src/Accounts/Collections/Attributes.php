<?php

namespace Enraiged\Accounts\Collections;

use Enraiged\Support\Collections\Fillable;

class Attributes
{
    use Fillable;

    /** @var  array  The fillable attributes. */
    static $fillable = [
        'email',
        'is_active',
        'is_hidden',
        'is_protected',
        'password',
        'role_id',
        'timezone',
        'username',
    ];
}
