<?php

namespace App\Http\Requests\Auth;

use Enraiged\Forms\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PasswordConfirmRequest extends FormRequest
{
    /**
     *  Handle the request to confirm a password.
     *
     *  @return void
     */
    public function handle(): void
    {
        $parameters = [
            'email' => $this->user()->email,
            'password' => $this->get('password'),
        ];

        $validation = Auth::guard('web')->validate($parameters);

        if (!$validation) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $this->success(true);
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        return [
            'password' => ['required'],
        ];
    }
}
