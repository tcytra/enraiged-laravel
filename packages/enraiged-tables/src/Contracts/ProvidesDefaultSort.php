<?php

namespace Enraiged\Tables\Contracts;

interface ProvidesDefaultSort
{
    /**
     *  Apply default sort criteria to the table builder.
     *
     *  @return void
     */
    public function defaultSort();
}
