<?php

namespace App\Http\Requests\Auth\Password\Forgot;

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
        return config('enraiged.auth.allow_password_reset') === true;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
}
