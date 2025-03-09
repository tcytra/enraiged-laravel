<?php

namespace App\Http\Requests\Auth\Register;

use App\System\Passwords\Rules\PasswordRules;
use App\System\Users\Models\User;
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
        return config('enraiged.auth.allow_registration') === true;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'locale' => 'required|string|min:2|max:2|in:en,es,fr',
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', new PasswordRules],
        ];
    }
}
