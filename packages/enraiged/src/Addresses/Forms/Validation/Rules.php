<?php

namespace Enraiged\Addresses\Forms\Validation;

trait Rules
{
    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'city' => 'required|string',
        'country_id' => 'required|exists:countries,id',
        'is_default' => 'boolean',
        'notes' => 'string',
        'postal' => 'string|max:8',
        'region_id' => 'required|exists:regions,id',
        'street' => 'required|string',
        'suite' => 'nullable',
    ];
}
