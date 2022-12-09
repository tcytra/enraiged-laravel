<?php

namespace Enraiged\Accounts\Services;

use Enraiged\Accounts\Tables\Builders\IndexBuilder;
use Enraiged\Exports\Services\Exporter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IndexExporter extends Exporter implements ShouldQueue, WithHeadings, WithMapping
{
    /**
     *  Create and return an Exporter instance from the provided TableBuilder.
     *
     *  @param  \Enraiged\Accounts\Tables\Builders\IndexBuilder  $table
     *  @return \Enraiged\Accounts\Exports\IndexExport
     */
    public static function From(IndexBuilder $table)
    {
        return new IndexExporter($table);
    }
}
