<?php

namespace App\Http\Requests\Auth\Login;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize(): bool
    {
        return config('enraiged.auth.allow_login') === true;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $allow_username_login = config('enraiged.auth.allow_secondary_credential')
            && config('enraiged.auth.allow_username_login');

        return [
            'email' => $allow_username_login ? 'required|string' : 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     *  Prepare the credentials form authentication attempts.
     *
     *  @return bool
     */
    private function attempt(): bool
    {
        $primary_credentials = collect($this->only('email', 'password'))
            ->merge(['is_active' => true])
            ->toArray();

        $secondary_credentials = collect($primary_credentials)
            ->merge(['username' => $this->get('email')])
            ->except('email')
            ->toArray();

        $allow_secondary_credentials = config('enraiged.auth.allow_secondary_credential') === true;

        return $this->attemptLoginWith($primary_credentials)
            || ($allow_secondary_credentials && $this->attemptLoginWith($secondary_credentials));
    }

    /**
     *  Execute an attempt to authenticate the provided credentials.
     *
     *  @param  array   $credentials
     *  @return bool
     */
    private function attemptLoginWith($credentials): bool
    {
        return Auth::attempt($credentials, $this->boolean('remember'));
    }

    /**
     *  Attempt to authenticate the request's credentials.
     *
     *  @return void
     *
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! $this->attempt()) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
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
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
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
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
