<?php

namespace App\Http\Requests\Users\Settings;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Users\Forms\Validation\Rules;

class UpdateRequest extends FormRequest
{
    use Rules;

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        return collect($this->rules)
            ->only(['dateformat', 'language', 'theme', 'timeformat', 'timezone'])
            ->toArray();
    }
}
