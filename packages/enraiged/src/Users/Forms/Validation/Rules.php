<?php

namespace Enraiged\Users\Forms\Validation;

use Enraiged\Enums\Roles;
use Illuminate\Support\Collection;

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

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        if (!$this->user()->role->atLeast(Roles::Administrator)) {
            $this->rules = collect($this->rules)
                ->except(['role_id'])
                ->toArray();
        }

        if ($this->route()->hasParameter('attribute')) {
            return $this
                ->uniqueUserRules()
                ->only($this->route()->parameter('attribute'))
                ->toArray();
        }

        return $this
            ->uniqueUserRules()
            ->toArray();
    }

    /**
     *  Return a collection of the full set of rules enforcing unique user email,username.
     *
     *  @return \Illuminate\Support\Collection
     */
    protected function uniqueUserRules(): Collection
    {
        $user_id = $this->route('user');

        $rules = [
            'email' => "required|email|unique:users,email,{$user_id}|unique:users,username,{$user_id}",
            'password' => 'nullable|confirmed',
            'username' => "nullable|email|unique:users,email,{$user_id}|unique:users,username,{$user_id}",
        ];

        return collect($this->rules)
            ->merge($rules);
    }
}
