<?php

namespace Enraiged\Agreements\Enums;

use Enraiged\Enums\Services\Enum;

class AgreementType extends Enum
{
    const EULA = 'EULA';
    const TOS = 'TOS';

    /** @var  array  The enum data descriptions. */
    protected static array $data = [
        self::EULA => 'End User Licence Agreement',
        self::TOS => 'Terms Of Service',
    ];
}
