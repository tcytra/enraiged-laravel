<?php

namespace App\Http\Requests\Users;

use Enraiged\Forms\Requests\FormRequest as Request;

class AvailabilityRequest extends Request
{
    /** @var  array  The custom error messages for the validations. */
    protected $messages = [
        'limit.integer' => 'The limit parameter must be an integer',
        'search.string' => 'The search parameter must be a string',
    ];

    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'limit' => 'nullable|integer',
        'search' => 'nullable|string',
        'role_id' => 'nullable|integer',
    ];
}
