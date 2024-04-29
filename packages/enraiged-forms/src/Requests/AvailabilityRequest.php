<?php

namespace Enraiged\Forms\Requests;

use Enraiged\Forms\Requests\FormRequest as Request;

class AvailabilityRequest extends Request
{
    /** @var  array  The columns selected for the available options. */
    protected $columns = [
        'id',
        'name',
    ];

    /** @var  array  The custom error messages for the validations. */
    protected $messages = [
        'limit.integer' => 'The limit parameter must be an integer',
        'search.string' => 'The search parameter must be a string',
    ];

    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'limit' => 'nullable|integer',
        'search' => 'nullable|string',
    ];

    /**
     *  Get the columns to select for the available options.
     *
     *  @return array
     */
    public function columns()
    {
        return property_exists($this, 'columns')
            ? $this->columns
            : [];
    }
}
