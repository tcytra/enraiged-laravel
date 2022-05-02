<?php

namespace Enraiged\Http\Requests\Accounts\Login;

use Enraiged\Accounts\Forms\Validation\Messages;

class UpdateRequest extends EditRequest
{
    use Messages;

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        $account = preg_match('/^my\.login/', $this->route()->getName())
            ? $this->user()->account
            : $this->route('account');

        return [
            'email' => "required|email|unique:users,email,{$account->id}|unique:users,username,{$account->id}",
            'password' => 'nullable|confirmed',
            'username' => "nullable|email|unique:users,email,{$account->id}|unique:users,username,{$account->id}",
        ];
    }
}
