<?php

namespace Enraiged\Profiles\Collections;

use Enraiged\Support\Collections\Fillable;

class Attributes
{
    use Fillable;

    public static $fillable = [
        'birthday', 'first_name', 'gender', 'last_name', 'salut', 'title',
    ];
}
