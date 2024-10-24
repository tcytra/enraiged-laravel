<?php

namespace App\Http\Requests\Avatars;

use Enraiged\Avatars\Traits\Validation\Rules;
use Enraiged\Forms\Requests\FormRequest;

class UploadRequest extends FormRequest
{
    use Rules;
}
