<?php

namespace App\Auth\Enums;

use LaravelEnso\Enums\Services\Enum;

final class Roles extends Enum
{
    public const Administrator = 1;
    public const Member = 2;
}
