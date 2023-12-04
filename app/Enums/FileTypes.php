<?php

namespace App\Enums;

use Enraiged\Enums\Services\Enum;

class FileTypes extends Enum
{
    public const JSON = 'application/json';
    public const PDF = 'application/pdf';

    public const GIF = 'image/gif';
    public const JPG = 'image/jpeg';
    public const PNG = 'image/png';

    public const TXT = 'text/plain';
    public const PHP = 'text/x-php';
}
