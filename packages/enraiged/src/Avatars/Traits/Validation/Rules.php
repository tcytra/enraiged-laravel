<?php

namespace Enraiged\Avatars\Traits\Validation;

trait Rules
{
    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'image' => [
            'required',
            'image',
            'mimes:jpeg,png,gif',
            'max:2048',
            'dimensions:min_width=250,min_height=250',//ratio=1/1
        ],
    ];
}
