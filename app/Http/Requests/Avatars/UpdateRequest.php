<?php

namespace App\Http\Requests\Avatars;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'color' => 'required|sometimes',
    ];
}
