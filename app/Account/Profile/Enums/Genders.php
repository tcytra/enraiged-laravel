<?php

namespace App\Account\Profile\Enums;

use LaravelEnso\Enums\Services\Enum;

class Genders extends Enum
{
    public const Female = 1;
    public const Male = 2;

    protected static array $data = [
        self::Female => 'female',
        self::Male => 'male',
    ];
}
