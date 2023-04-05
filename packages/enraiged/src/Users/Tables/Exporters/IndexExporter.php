<?php

namespace Enraiged\Users\Tables\Exporters;

use Enraiged\Exports\Services\Exporter;
use Enraiged\Exports\Contracts\ExportFrom;
// use Enraiged\Users\Tables\Builders\UserIndex;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IndexExporter extends Exporter implements ExportFrom, ShouldQueue, WithHeadings, WithMapping
{
    /**
     *  Create and return an Exporter instance from the provided TableBuilder.
     *
     *  @param  \Enraiged\Users\Tables\Builders\UserIndex  $table
     *  @return \Enraiged\Users\Exports\IndexExport
     */
    public static function From($table): Exporter
    {
        return new IndexExporter($table);
    }
}
