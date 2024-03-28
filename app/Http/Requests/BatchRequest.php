<?php

namespace App\Http\Requests;

use Enraiged\Forms\Requests\FormRequest;

class BatchRequest extends FormRequest
{
    /** @var  array  The validation rules that apply to the request. */
    protected $rules = [
        'selected' => 'required|array',
        'selected.*' => 'integer',
    ];
}
