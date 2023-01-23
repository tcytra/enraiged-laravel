<?php

namespace App\Http\Requests\Avatars;

use Enraiged\Avatars\Traits\Validators\AvatarColorValidator;
use Enraiged\Forms\Requests\FormRequest;

class UpdateRequest extends FormRequest
{
    use AvatarColorValidator;

    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'color' => 'required',
    ];
}
