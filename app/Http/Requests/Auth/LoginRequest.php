<?php

namespace App\Http\Requests\Auth;

use Enraiged\Forms\Requests\FormRequest;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        return [
            'email' => config('enraiged.auth.allow_username_login') ? 'required|string' : 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     *  Execute the attempt to authenticate the request's credentials.
     *
     *  @return boolean
     */
    private function attempt()
    {
        $primary_credentials = collect($this->only('email', 'password'))
            ->merge(['is_active' => true])
            ->toArray();

        $secondary_credentials = collect($primary_credentials)
            ->merge(['username' => $this->get('email')])
            ->except('email')
            ->toArray();

        return Auth::attempt($primary_credentials, $this->boolean('remember'))
            || (config('enraiged.auth.allow_secondary_credential') === true
                && Auth::attempt($secondary_credentials, $this->boolean('remember')));
    }

    /**
     *  Prepare for and handle the attempt to authenticate the request's credentials.
     *
     *  @return void
     *
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (!$this->attempt()) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        if (config('enraiged.auth.track_ip_addresses')) {
            $this->user()->trackIp($this->ip());
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     *  Ensure the login request is not rate limited.
     *
     *  @return void
     *
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     *  Get the rate limiting throttle key for the request.
     *
     *  @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
