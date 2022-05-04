<?php

namespace Enraiged\Http\Requests\Accounts\Settings;

use Enraiged\Accounts\Forms\Validation\Rules;

class UpdateRequest extends EditRequest
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
            ->only(['timezone'])
            ->toArray();
    }
}
