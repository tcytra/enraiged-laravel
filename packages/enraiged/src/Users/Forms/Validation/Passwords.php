<?php

namespace Enraiged\Users\Forms\Validation;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait Passwords
{
    /**
     *  @param  array   $matches
     *  @return bool
     */
    protected function checkLength($matches): bool
    {
        return Str::length(collect($matches)->flatten()->implode(''));
    }

    /**
     *  @param  User|null  $user
     *
     *  @return bool
     */
    protected function passwordHistory($user = null): bool
	{
        $config = config('enraiged.password.history');
        $user = $user ?? $this->user();

		if ($config) {
            return $user->passwordHistory()
                ->orderBy('created_at', 'desc')
                ->limit(config('enraiged.password.history'))
                ->pluck('password')
                ->contains(function($password){
                    return Hash::check($this->get('password'), $password);
                });
        }

        return false;
	}

    /**
     *  @return bool
     */
    protected function passwordLowercase(): bool
    {
        $config = config('enraiged.password.lowercase');

        if ($config) {
            preg_match_all('/[a-z]+/', $this->get('password'), $matches);

            return $this->checkLength($matches) >= $config;
        }

        return true;
    }

    /**
     *  @return bool
     */
    protected function passwordNumeric(): bool
    {
        $config = config('enraiged.password.numeric');

        if ($config) {
            preg_match_all('/[0-9]+/', $this->get('password'), $matches);

            return $this->checkLength($matches) >= $config;
        }

        return true;
    }

    /**
     *  @return bool
     */
    protected function passwordMinLength(): bool
    {
        $config = config('enraiged.password.length');

        if ($config) {
            return strlen($this->get('password')) >= $config;
        }

        return true;
    }

    /**
     *  @return bool
     */
    protected function passwordSpecial(): bool
    {
        $config = config('enraiged.password.special');

        if ($config) {
            preg_match_all('/[^a-zA-Z0-9]+/', $this->get('password'), $matches);

            return $this->checkLength($matches) >= $config;
        }

        return true;
    }

    /**
     *  @return bool
     */
    protected function passwordUppercase(): bool
    {
        $config = config('enraiged.password.uppercase');

        if ($config) {
            preg_match_all('/[A-Z]+/', $this->get('password'), $matches);

            return $this->checkLength($matches) >= config('enraiged.password.uppercase');
        }

        return true;
    }

    /**
     *  Configure the validator instance.
     *
     *  @param  \Illuminate\Validation\Validator  $validator
     *  @return void
     */
	public function withValidator($validator)
    {
        if ($this->filled('password')) {
            $validator->after(function ($validator) {
                // $creating = $this->method() === 'POST';
                $updating = $this->method() === 'PATCH' && !is_null($this->user);
                $user = $updating ? auth_model()::find($this->user) : null;

                if ($user) {
                    if ($user->currentPasswordIs($this->get('password'))) {
                        $validator->errors()->add('password', $this->messages['password.current']);
                    }

                    if ($this->passwordHistory($user)) {
                        $validator->errors()->add('password', $this->messages['password.history']);
                    }
                }

                if (!$this->passwordMinLength()) {
                    $error = __($this->messages['password.length'], [
                        'number' => config('enraiged.password.length'),
                    ]);

                    $validator->errors()->add('password', $error);
                }

                if (!$this->passwordUppercase()) {
                    $error = __($this->messages['password.uppercase'], [
                        'number' => config('enraiged.password.uppercase'),
                        'plural' => config('enraiged.password.uppercase') > 1 ? 'letters' : 'letter',
                    ]);

                    $validator->errors()->add('password', $error);
                }

                if (!$this->passwordLowercase()) {
                    $error = __($this->messages['password.lowercase'], [
                        'number' => config('enraiged.password.lowercase'),
                        'plural' => config('enraiged.password.lowercase') > 1 ? 'letters' : 'letter',
                    ]);

                    $validator->errors()->add('password', $error);
                }

                if (!$this->passwordNumeric()) {
                    $error = __($this->messages['password.numeric'], [
                        'number' => config('enraiged.password.numeric'),
                        'plural' => config('enraiged.password.numeric') > 1 ? 'numbers' : 'number',
                    ]);

                    $validator->errors()->add('password', $error);
                }

                if (!$this->passwordSpecial()) {
                    $error = __($this->messages['password.special'], [
                        'number' => config('enraiged.password.special'),
                        'plural' => config('enraiged.password.special') > 1 ? 'characters' : 'character',
                    ]);

                    $validator->errors()->add('password', $error);
                }
            });
        }
    }
}
