<?php

namespace App\Http\Requests\Users\Login;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Users\Forms\Validation\Messages;
use Enraiged\Users\Forms\Validation\Passwords;

class UpdateRequest extends FormRequest
{
    use Messages, Passwords;

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
            'username' => config('enraiged.auth.allow_username_login')
                ? "nullable|unique:users,email,{$user->id}|unique:users,username,{$user->id}"
                : "nullable|email|unique:users,email,{$user->id}|unique:users,username,{$user->id}",
        ];
    }
}
