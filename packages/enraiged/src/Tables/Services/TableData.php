<?php

namespace Enraiged\Tables\Services;

class TableData
{
    /** @var  array  The completed pagination object. */
    protected $pagination;

    /** @var  object  The http request object. */
    protected $request;

    /**
     *  Create an instance of the TableData service.
     *
     *  @param  object  $builder
     *  @return void
     */
    public function __construct($builder)
    {
        $this->pagination = $builder->pagination();
        $this->records = $builder->records();
        $this->request = $builder->request();
    }

    /**
     *  Format a response from the table builder.
     *
     *  @return array
     */
    public function toArray(): array
    {
        $pagination = (object) $this->pagination;

        return [
            'filters' => $this->request->get('filters'),
            'records' => $this->records,
            'pagination' => [
                'dir' => $this->request->get('dir'),
                'page' => $pagination->current_page,
                'rows' => $pagination->per_page,
                'sort' => $this->request->get('sort'),
                'total' => $pagination->total,
            ],
            'search' => $this->request->get('search'),
        ];
    }

    /**
     *  Create a TableData instance and return a processed array.
     *
     *  @param type $builder
     *  @return type
     */
    public static function From($builder)
    {
        $service = new TableData($builder);

        return $service->toArray();
    }
}
