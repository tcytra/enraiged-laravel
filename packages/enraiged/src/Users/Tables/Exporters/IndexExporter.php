<?php

namespace Enraiged\Users\Tables\Exporters;

use Enraiged\Exports\Services\Exporter;
use Enraiged\Exports\Contracts\ExportFrom;
use Illuminate\Contracts\Queue\ShouldQueue;

class IndexExporter extends Exporter implements ExportFrom, ShouldQueue, WithHeadings, WithMapping
{
    /**
     *  Create and return an Exporter instance from the provided TableBuilder.
     *
     *  @param  \Enraiged\Tables\Builders\TableBuilder  $table
     *  @return \Enraiged\Users\Exports\IndexExport
     */
    public static function From($table): Exporter
    {
        return new IndexExporter($table);
    }
}
