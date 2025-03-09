<?php

namespace App\Http\Requests\Users\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Request extends FormRequest
{
    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $model = config('auth.providers.users.model');

        $user = $this->is('my/*')
            ? $this->user()
            : $model::findOrFail($this->user);

        return [
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique($model)->ignore($user->id),
            ],
            'locale' => ['required', 'string', 'min:2', 'max:2', 'in:en,es,fr'],
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
