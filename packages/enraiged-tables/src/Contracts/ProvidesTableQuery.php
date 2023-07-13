<?php

namespace Enraiged\Tables\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface ProvidesTableQuery
{
    /**
     *  Provide the initial query builder for this table.
     *
     *  @return \Illuminate\Database\Eloquent\Builder|Illuminate\Database\Query\Builder
     */
    public function query(): Builder;
}
