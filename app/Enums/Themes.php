<?php

namespace App\Enums;

use Enraiged\Enums\Services\Enum;

class Themes extends Enum
{
    public const EnraigedBlue = 'enraiged-blue';
    public const EnraigedGrey = 'enraiged-grey';

    protected static array $data = [
        self::EnraigedBlue => 'Enraiged Blue',
        self::EnraigedGrey => 'Enraiged Grey',
    ];
}
