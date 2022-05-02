<?php

namespace Enraiged\Http\Requests\Accounts;

use Enraiged\Accounts\Tables\Builders\IndexBuilder;
use Enraiged\Tables\Contracts\ProvidesTableBuilder;
use Enraiged\Tables\Requests\TableRequest;

class IndexRequest extends TableRequest implements ProvidesTableBuilder
{
    /**
     *  Create and return a TableBuilder from the current Request.
     *
     *  @return \Enraiged\Tables\Builders\IndexBuilder
     */
    public function table()
    {
        if (!$this->table) {
            $this->table = IndexBuilder::from($this);
        }

        return $this->table;
    }
}
