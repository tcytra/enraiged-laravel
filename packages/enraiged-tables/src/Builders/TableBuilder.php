<?php

namespace Enraiged\Tables\Builders;

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
        $query = method_exists($this, 'query')
            ? $this->query()
            : $this->model::query();

        $this->build($query)
            ->sort()
            ->filter()
            ->search()
            ->paginate();

        $pagination = (object) $this->pagination();

        return [
            'records' => $this->records(),
            'pagination' => [
                'dir' => $this->request->dir(),
                'page' => $pagination->current_page,
                'rows' => $pagination->per_page,
                'sort' => $this->request->sort(),
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
        $identity = $this->get('id') ?? $this->prefix().'index';

        $template = [
            'actions' => $this->assembleTemplateActions(),
            'class' => $this->get('class') ?? str_replace('.', '-', $identity),
            'columns' => $this->assembleTemplateColumns(),
            'empty' => $this->get('empty'),
            'id' => $identity,
            'exportable' => $this->get('exportable'),
            'key' => $this->get('key'),
            'pagination' => $this->get('pagination'),
            'state' => $this->get('state'),
            'uri' => $this->assembleTemplateUri(),
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
