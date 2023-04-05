<?php

namespace Enraiged\Exports\Contracts;

use Enraiged\Exports\Services\Exporter;

interface ExportFrom
{
    /**
     *  Create and return an Exporter instance from the provided TableBuilder.
     *
     *  @param  \Enraiged\Tables\Builders\TableBuilder  $table
     *  @return \Enraiged\Users\Exports\IndexExport
     */
    public static function From($table): Exporter;
}
