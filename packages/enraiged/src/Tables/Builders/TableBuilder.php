<?php

namespace Enraiged\Tables\Builders;

use Enraiged\Tables\Services\TableData;
use Enraiged\Tables\Services\TableTemplate;

class TableBuilder
{
    use Traits\BuilderConstructor,
        Traits\EloquentBuilder,
        Traits\Exportable,
        Traits\HttpRequest,
        Traits\TableActions,
        Traits\TableColumns;

    /**
     *  Return the data for the table request.
     *
     *  @return array
     */
    public function data(): array
    {
        $this->build($this->model::query())
            ->sort()
            ->filter()
            ->search()
            ->paginate(); // paginate last!

        return TableData::from($this);
    }

    /**
     *  Return the assembled table template.
     *
     *  @return array
     */
    public function template(): array
    {
        return TableTemplate::from($this);
    }
}
