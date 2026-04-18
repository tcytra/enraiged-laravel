<?php

namespace App\Packages\Users\Forms\Validation;

use App\Packages\Users\Models\User;
use Enraiged\Geo\Models\Country;
use Enraiged\Passwords\Forms\Validation\PasswordRules;
use Enraiged\Users\Enums\Roles;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

trait Rules
{
    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'is_active' => 'boolean',
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:16',
        'salut' => 'nullable|string',
        'theme' => 'array',
        'timezone' => 'nullable|string|max:100',
    ];

    /**
     *  Assemble and return the email validation rule for the request.
     *
     *  @param  \App\Packages\Users\Models\User  $user
     *  @param  string  $roles
     *  @return array
     */
    protected function validateEmailRule(User $user, string $roles)
    {
        $table = $user->getTable();

        return [
            'required',
            'string',
            'lowercase',
            'email',
            'max:255',
            Rule::unique($table, 'email')->ignore($user->id),
        ];
    }

    /**
     *  Assemble and return the locale validation rule for the request.
     *
     *  @param  \App\Packages\Users\Models\User  $user
     *  @param  string  $roles
     *  @return array
     */
    protected function validateLocaleRule(User $user, string $roles)
    {
        $locales = collect(config('enraiged.locales'))
            ->keys()
            ->join(',');

        return [
            'sometimes',
            'required',
            'string',
            'min:2',
            'max:2',
            "in:{$locales}",
        ];
    }

    /**
     *  Assemble and return the role_id validation rule for the request.
     *
     *  @param  \App\Packages\Users\Models\User  $user
     *  @param  string  $roles
     *  @return array|null
     */
    protected function validateRoleIdRule(User $user, string $roles)
    {
        $admin = config('auth.providers.roles.admin', 'Administrator');

        if ($this->user()->role->is($roles::find($admin))) {
            return [
                'required',
                'int',
                'in:'.collect($roles::ids())->join(','),
            ];
        }

        return null;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $model = config('auth.providers.users.model');
        $roles = config('auth.providers.roles.enum', Roles::class);

        $rules = [];

        if ($this->routeIs('my.*')) {
            $user = $this->user();

        } else {
            $user = $this->user
                ? $model::findOrFail($this->user)
                : new $model;
        }

        $rules = [
            'password' => [
                $user->exists ? 'nullable' : 'required',
                'confirmed',
                new PasswordRules],
        ];

        if ($this->user()->role->is($roles::find('Administrator'))) {
            $rules = [
                ...$rules,
                'is_hidden' => 'boolean',
                'is_protected' => 'boolean',
            ];
        }

        foreach (collect($this->all()) as $index => $value) {
            if (key_exists($index, $this->rules)) {
                $rules[$index] = $this->rules[$index];

            } else {
                $method = 'validate'.ucwords(Str::camel($index)).'Rule';

                if (method_exists($this, $method) && $rule = $this->{$method}($user, $roles)) {
                    $rules[$index] = $rule;
                }
            }
        }

        if ($this->filled('country_id') && $country = Country::find($this->get('country_id'))) {
            $rules['timezone'] = "{$rules['timezone']}|timezone:per_country,{$country->code}";
        }

        return $this->attribute
            ? collect($rules)
                ->only($this->attribute)
                ->toArray()
            : $rules;
    }
}
