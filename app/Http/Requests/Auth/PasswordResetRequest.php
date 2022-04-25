<?php

namespace App\Http\Requests\Auth;

use Enraiged\Forms\Requests\FormRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetRequest extends FormRequest
{
    /** @var  array  The custom error messages for the validations. */
    protected $messages = [
        'email.exists' => 'This email address cannot be identified in the system.',
    ];

    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'token' => 'required',
        'email' => 'required|email|exists:users',
        'password' => 'required|confirmed',
    ];

    /**
     *  Handle the request to reset the password.
     *
     *  @return void
     */
    public function handle(): void
    {
        $this->status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        $this->success(Password::PASSWORD_RESET == $this->status);
    }
}
