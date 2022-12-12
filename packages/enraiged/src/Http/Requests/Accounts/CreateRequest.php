<?php

namespace Enraiged\Http\Requests\Accounts;

use Enraiged\Accounts\Forms\Validation\Messages;
use Enraiged\Accounts\Forms\Validation\Rules;
use Enraiged\Forms\Requests\FormRequest;

class CreateRequest extends FormRequest
{
    use Messages, Rules;

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        return collect($this->rules)
            ->only(['email', 'password', 'role_id'])
            ->merge(['name' => 'required|string'])
            ->toArray();
    }
}
