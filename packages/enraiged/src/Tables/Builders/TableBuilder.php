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
        $query = method_exists($this, 'query')
            ? $this->query()
            : $this->model::query();

        $this->build($query)
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

    /**
     *  Create and return a builder from the request and optional parameters.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array  $parameters = []
     *  @return \Enraiged\Tables\Builders\TableBuilder
     *  @static
     */
    public static function From($request, $parameters = [])
    {
        $called = get_called_class();

        return new $called($request, $parameters);
    }
}
