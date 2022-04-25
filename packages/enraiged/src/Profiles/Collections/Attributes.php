<?php

namespace Enraiged\Profiles\Collections;

use Enraiged\Support\Collections\Fillable;

class Attributes
{
    use Fillable;

    /** @var  array  The fillable attributes. */
    public static $fillable = [
        'alias',
        'birthdate',
        'first_name',
        'last_name',
        'gender',
        'salut',
        'title',
    ];
}
