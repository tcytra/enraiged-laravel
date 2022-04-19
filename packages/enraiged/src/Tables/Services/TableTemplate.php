<?php

namespace Enraiged\Tables\Services;

class TableTemplate
{
    /** @var  array  The completed pagination object. */
    protected $builder;

    /**
     *  Create an instance of the TableTemplate service.
     *
     *  @param  object  $builder
     *  @return void
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     *  Format a response from the table builder.
     *
     *  @return array
     */
    public function toArray(): array
    {
        $builder = $this->builder;

        return [
            'actions' => $builder->actionsForTable(),
            'columns' => $builder->columns(),
            'empty' => $builder->get('empty'),
            'id' => $builder->get('id') ?? $builder->prefix().'index',
            'exportable' => $builder->get('exportable'),
            'key' => $builder->get('key'),
            'pagination' => $builder->get('pagination'),
            'state' => $builder->get('state'),
            'uri' => $builder->uri(),
        ];
    }

    /**
     *  Create a TableTemplate instance and return a processed array.
     *
     *  @param  object  $builder
     *  @return array
     */
    public static function From($builder): array
    {
        $template = new TableTemplate($builder);

        return $template->toArray();
    }
}
