<?php

namespace App\Http\Requests\Auth;

use Enraiged\Forms\Requests\FormRequest;
use Illuminate\Support\Facades\Password;

class PasswordForgotRequest extends FormRequest
{
    /** @var  array  The custom error messages for the validations. */
    protected $messages = [
        'email.exists' => 'This email address cannot be identified in the system.',
    ];

    /** @var  array  the validation rules that apply to the request. */
    protected $rules = [
        'email' => 'required|email|exists:users',
    ];

    /**
     *  Handle the request to begin a password reset.
     *
     *  @return void
     */
    public function handle(): void
    {
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $this->status = Password::sendResetLink(
            $this->only('email')
        );

        $this->success($this->status == Password::RESET_LINK_SENT);
    }
}
