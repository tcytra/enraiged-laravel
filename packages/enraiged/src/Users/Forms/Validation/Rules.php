<?php

namespace Enraiged\Users\Forms\Validation;

trait Rules
{
    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'alias' => 'nullable|sometimes',
        'birthdate' => 'nullable|date',
        'dateformat' => 'nullable|string',
        'email' => 'required|email|unique:users,email|unique:users,username',
        'first_name' => 'required',
        'gender' => 'nullable',
        'is_active' => 'boolean',
        'language' => 'nullable|string',
        'last_name' => 'required',
        'password' => 'required|confirmed',
        'role_id' => 'nullable|exists:roles,id',
        'salut' => 'nullable',
        'theme' => 'nullable|string|max:32',
        'timeformat' => 'nullable|string',
        'timezone' => 'nullable',
        'title' => 'nullable',
        'username' => 'sometimes|nullable|unique:users,username|unique:users,email',
    ];
}
