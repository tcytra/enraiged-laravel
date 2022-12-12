<?php

namespace Enraiged\Http\Requests\Accounts;

use Enraiged\Accounts\Forms\Validation\Messages;
use Enraiged\Accounts\Forms\Validation\Rules;
use Enraiged\Forms\Requests\FormRequest;

class UpdateRequest extends FormRequest
{
    use Messages, Rules;

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        $account_id = $this->route('account')->id;

        $rules = [
            'email' => "required|email|unique:users,email,{$account_id}|unique:users,username,{$account_id}",
            'password' => 'nullable|confirmed',
            'username' => "nullable|email|unique:users,email,{$account_id}|unique:users,username,{$account_id}",
        ];

        return collect($this->rules)
            ->merge($rules)
            ->toArray();
    }
}
