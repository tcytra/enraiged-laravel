<?php

namespace Enraiged\Exports\Contracts;

use Enraiged\Exports\Services\Exporter;

interface ExportFrom
{
    public static function From($table): Exporter;
}
