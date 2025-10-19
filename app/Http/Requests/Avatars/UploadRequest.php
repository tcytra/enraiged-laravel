<?php

namespace App\Http\Requests\Avatars;

use Enraiged\Avatars\Forms\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    use Rules;
}
