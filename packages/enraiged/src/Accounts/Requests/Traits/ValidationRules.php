<?php

namespace Enraiged\Accounts\Requests\Traits;

trait ValidationRules
{
    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'birthday' => 'nullable|date',
        'email' => 'required|email|unique:users,email|unique:users,username',
        'first_name' => 'required',
        'gender' => 'nullable',
        'last_name' => 'required',
        'password' => 'required|confirmed',
        'salut' => 'nullable|sometimes',
        'timezone' => 'nullable',
        'title' => 'nullable|sometimes',
        'username' => 'nullable|email|unique:users,username|unique:users,email',
    ];

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     *
    public function rules()
    {
        return collect($this->rules)
            ->toArray();
    }*/
}
