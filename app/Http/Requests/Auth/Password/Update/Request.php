<?php

namespace App\Http\Requests\Auth\Password\Update;

use Enraiged\Passwords\Forms\Validation\PasswordRules;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed', new PasswordRules],
        ];
    }
}
