<?php

namespace Enraiged\Tables\Builders;

use Enraiged\Support\Builders\UriBuilder;
use Enraiged\Tables\Contracts\ProvidesTableQuery;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class TableBuilder
{
    use Traits\BuilderConstructor,
        Traits\EloquentBuilder,
        Traits\Exportable,
        Traits\HttpRequest,
        Traits\SecurityAssertions,
        Traits\TableActions,
        Traits\TableColumns,
        Traits\TableFilters;

    /**
     *  Return the data for the table request.
     *
     *  @return array
     */
    public function data(): array
    {
        $query = $this instanceof ProvidesTableQuery
            ? $this->query()
            : App::make($this->model)::query();

        $this->builder($query)
            ->sort()
            ->filter()
            ->search()
            ->paginate();

        $pagination = (object) $this->pagination();

        return [
            'records' => $this->records(),
            'pagination' => [
                'dir' => $this->request->get('dir'),
                'page' => $pagination->current_page,
                'rows' => $pagination->per_page,
                'sort' => $this->request->get('sort'),
                'total' => $pagination->total,
            ],
        ];
    }

    /**
     *  Initiate the table export process.
     *
     *  @return void
     */
    public function export()
    {
        $this->exporter()->process();
    }

    /**
     *  Return the assembled table template.
     *
     *  @return array
     */
    public function template(): array
    {
        $identity = $this->get('id') ?? trim($this->prefix, '.').'index';

        $template = [
            'actions' => $this->assembleTemplateActions(),
            'class' => $this->get('class') ?? str_replace('.', '-', $identity),
            'columns' => $this->assembleTemplateColumns(),
            'empty' => $this->get('empty'),
            'id' => $identity,
            'exportable' => $this->assembleExportableConfiguration(),
            'key' => $this->get('key'),
            'model' => Str::snake(class_basename($this->model)),
            'pagination' => $this->get('pagination'),
            'state' => $this->get('state'),
            'uri' => UriBuilder::from($this->uri, $this->request->get('route'))->uri(),
        ];

        if ($this->filters) {
            $filters = $this->assembleTemplateFilters();

            if (count($filters)) {
                $template['filters'] = $filters;
            }
        }

        return $template;
    }
}
