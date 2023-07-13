<?php

namespace Enraiged\Agreements\Enums;

use Enraiged\Enums\Services\Enum;

class AgreementStatus extends Enum
{
    const Archived = 'A';
    const Draft = 'D';
    const Published = 'P';
    const Reviewing = 'R';

    /** @var  array  The enum data descriptions. */
    protected static array $data = [
        self::Archived => 'Archived',
        self::Draft => 'Draft',
        self::Published => 'Published',
        self::Reviewing => 'Reviewing',
    ];
}
