<?php

namespace App\Auth\Traits\Validators;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait PasswordValidator
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
     *  @return bool
     */
    protected function passwordHistory(): bool
	{
        $config = config('password.history');

		if ($config && Auth::check()) {
            return $this->user()->passwordHistory()
                ->orderBy('created_at', 'desc')
                ->limit(config('password.history'))
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
        $config = config('password.lowercase');

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
        $config = config('password.numeric');

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
        $config = config('password.length');

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
        $config = config('password.special');

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
        $config = config('password.uppercase');

        if ($config) {
            preg_match_all('/[A-Z]+/', $this->get('password'), $matches);

            return $this->checkLength($matches) >= config('password.uppercase');
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
                if (Auth::check()) {
                    if ($this->user()->currentPasswordIs($this->get('password'))) {
                        $validator->errors()->add('password', $this->messages['password.current']);
                    }

                    if ($this->passwordHistory()) {
                        $validator->errors()->add('password', $this->messages['password.history']);
                    }
                }

                if (!$this->passwordMinLength()) {
                    $error = __($this->messages['password.length'], [
                        'number' => config('password.length'),
                    ]);

                    $validator->errors()->add('password', $error);
                }

                if (!$this->passwordUppercase()) {
                    $error = __($this->messages['password.uppercase'], [
                        'number' => config('password.uppercase'),
                        'plural' => config('password.uppercase') > 1 ? 'letters' : 'letter',
                    ]);

                    $validator->errors()->add('password', $error);
                }

                if (!$this->passwordUppercase()) {
                    $error = __($this->messages['password.uppercase'], [
                        'number' => config('password.uppercase'),
                        'plural' => config('password.uppercase') > 1 ? 'letters' : 'letter',
                    ]);

                    $validator->errors()->add('password', $error);
                }

                if (!$this->passwordLowercase()) {
                    $error = __($this->messages['password.lowercase'], [
                        'number' => config('password.lowercase'),
                        'plural' => config('password.lowercase') > 1 ? 'letters' : 'letter',
                    ]);

                    $validator->errors()->add('password', $error);
                }

                if (!$this->passwordNumeric()) {
                    $error = __($this->messages['password.numeric'], [
                        'number' => config('password.numeric'),
                        'plural' => config('password.numeric') > 1 ? 'numbers' : 'number',
                    ]);

                    $validator->errors()->add('password', $error);
                }

                if (!$this->passwordSpecial()) {
                    $error = __($this->messages['password.special'], [
                        'number' => config('password.special'),
                        'plural' => config('password.special') > 1 ? 'characters' : 'character',
                    ]);

                    $validator->errors()->add('password', $error);
                }
            });
        }
    }
}
