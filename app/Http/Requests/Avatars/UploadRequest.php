<?php

namespace App\Http\Requests\Avatars;

use Enraiged\Avatars\Traits\Validators\AvatarFileValidator;
use Enraiged\Forms\Requests\FormRequest;

class UploadRequest extends FormRequest
{
    use AvatarFileValidator;

    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'image' => [
            'required',
            'image',
            'mimes:jpeg,png,jpg,gif',
            'max:2048',
            'dimensions:min_width=250,min_height=250',
            'dimensions:ratio=1/1',
        ],
    ];
}
