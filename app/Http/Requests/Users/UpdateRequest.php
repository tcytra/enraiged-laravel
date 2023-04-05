<?php

namespace App\Http\Requests\Users;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Users\Forms\Validation\Messages;
use Enraiged\Users\Forms\Validation\Passwords;
use Enraiged\Users\Forms\Validation\Rules;

class UpdateRequest extends FormRequest
{
    use Messages, Passwords, Rules;

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        $user_id = $this->route('user');

        $rules = [
            'email' => "required|email|unique:users,email,{$user_id}|unique:users,username,{$user_id}",
            'password' => 'nullable|confirmed',
            'username' => "nullable|email|unique:users,email,{$user_id}|unique:users,username,{$user_id}",
        ];

        return collect($this->rules)
            ->merge($rules)
            ->toArray();
    }
}
