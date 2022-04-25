<?php

namespace Enraiged\Accounts\Forms\Validation;

trait Rules
{
    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'alias' => 'nullable|sometimes',
        'birthdate' => 'nullable|date',
        'email' => 'required|email|unique:users,email|unique:users,username',
        'first_name' => 'required',
        'gender' => 'nullable',
        'is_active' => 'sometimes|boolean',
        'last_name' => 'required',
        'password' => 'required|confirmed',
        'role_id' => 'nullable|exists:roles,id',
        'salut' => 'nullable|sometimes',
        'timezone' => 'nullable',
        'title' => 'nullable|sometimes',
        'username' => 'nullable|email|unique:users,username|unique:users,email',
    ];

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        return $this->rules;
    }
}
