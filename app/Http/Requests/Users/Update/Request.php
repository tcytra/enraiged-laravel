<?php

namespace App\Http\Requests\Users\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Request extends FormRequest
{
    /**
     *  Return the request success message.
     *
     *  @return string
     */
    public function message(): string
    {
        return $this->attribute
            ? "The user {$this->attribute} has been updated."
            : 'The user has been updated.';
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $locales = collect(config('enraiged.locales'))
            ->keys()
            ->join(',');

        $model = config('auth.providers.users.model');

        $user = $this->is('my/*')
            ? $this->user()
            : $model::findOrFail($this->user);

        $rules = [
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique($model, 'email')->ignore($user->id),
            ],
            'locale' => ['required', 'string', 'min:2', 'max:2', "in:{$locales}"],
            'name' => ['required', 'string', 'max:255'],
            'theme' => ['sometimes', 'array'],
        ];

        if (config('enraiged.auth.allow_secondary_credential') === true) {
            $rules['username'] = config('enraiged.auth.allow_username_login') === true
                ? ['nullable', 'string', 'max:255', Rule::unique($model, 'username')->ignore($user->id)]
                : ['nullable', 'string', 'email', 'max:255', Rule::unique($model, 'username')->ignore($user->id)];
        }

        return $this->attribute
            ? collect($rules)
                ->only($this->attribute)
                ->toArray()
            : $rules;
    }

    /**
     *  Get the validated data from the request.
     *
     *  @param  array|int|string|null  $key
     *  @param  mixed  $default
     *  @return mixed
     */
    public function validated($key = null, $default = null)
    {
        return $this->attribute
            ? [$this->attribute => parent::validated($this->attribute)]
            : parent::validated();
    }
}
