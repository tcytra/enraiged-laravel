<?php

namespace App\Http\Requests\Users;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Users\Forms\Validation\Messages;
use Enraiged\Users\Forms\Validation\Passwords;
use Enraiged\Users\Forms\Validation\Rules;

class CreateRequest extends FormRequest
{
    use Messages, Passwords, Rules;

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
