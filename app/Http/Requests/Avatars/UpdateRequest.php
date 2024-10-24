<?php

namespace App\Http\Requests\Avatars;

use Enraiged\Forms\Requests\FormRequest;

class UpdateRequest extends FormRequest
{
    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'color' => 'required|sometimes',
    ];
}
