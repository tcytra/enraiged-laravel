<?php

namespace App\Http\Requests\Users\Login;

use Enraiged\Users\Forms\Validation\Messages;

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
        $user = preg_match('/^my\.login/', $this->route()->getName())
            ? $this->user()
            : $this->route('user');

        return [
            'email' => "required|email|unique:users,email,{$user->id}|unique:users,username,{$user->id}",
            'password' => 'nullable|confirmed',
            'username' => "nullable|email|unique:users,email,{$user->id}|unique:users,username,{$user->id}",
        ];
    }
}
