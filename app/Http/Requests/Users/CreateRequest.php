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
            ->only(['country_id', 'email', 'password', 'role_id'])
            ->merge(['name' => 'required|string'])
            ->toArray();
    }

    /**
     *  Form and return a success message for this request.
     *
     *  @return string
     */
    public function successMessage(): string
    {
        return 'User Created';
    }

    /**
     *  Perform additional validation checks.
     *
     *  @param  \Illuminate\Support\Facades\Validator  $validator
     *  @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            (object) $this
                ->validatePasswordCase($validator)
                ->validatePasswordLength($validator)
                ->validatePasswordNumeric($validator)
                ->validatePasswordSpecial($validator);
        });
    }
}
