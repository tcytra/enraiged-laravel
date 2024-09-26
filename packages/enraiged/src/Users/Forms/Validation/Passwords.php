<?php

namespace Enraiged\Users\Forms\Validation;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait Passwords
{
    /**
     *  Test the password against the configured length requirement.
     *
     *  @param  array   $matches
     *  @return bool
     */
    protected function checkLength($matches): bool
    {
        $test = collect($matches)
            ->flatten()
            ->implode('');

        return Str::length($test);
    }

    /**
     *  Test the password history against the configured requirement.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    protected function passwordHistory($user): bool
	{
        $config = config('enraiged.password.history');

		if ($config) {
            $history = ($user ?? $this->user())->passwordHistory()
                ->orderBy('created_at', 'desc');

            if (gettype($config) === 'integer') {
                $history->limit(config('enraiged.password.history'));
            }

            return $history
                ->pluck('password')
                ->contains(fn ($password)
                    => Hash::check($this->get('password'), $password));
        }

        return false;
	}

    /**
     *  Test the password against the configured lowercase requirement.
     *
     *  @return bool
     */
    protected function passwordLowercase(): bool
    {
        $config = config('enraiged.password.lowercase');

        if ($config) {
            $matches = [];
            preg_match_all('/[a-z]+/', $this->get('password'), $matches);

            return $this->checkLength($matches) >= $config;
        }

        return true;
    }

    /**
     *  Test the password against the configured numeric character requirement.
     *
     *  @return bool
     */
    protected function passwordNumeric(): bool
    {
        $config = config('enraiged.password.numeric');

        if ($config) {
            $matches = [];
            preg_match_all('/[0-9]+/', $this->get('password'), $matches);

            return $this->checkLength($matches) >= $config;
        }

        return true;
    }

    /**
     *  Test the password against the minimum length requirement.
     *
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
     *  Test the password against the configured special character requirement.
     *
     *  @return bool
     */
    protected function passwordSpecial(): bool
    {
        $config = config('enraiged.password.special');

        if ($config) {
            $matches = [];
            preg_match_all('/[^a-zA-Z0-9]+/', $this->get('password'), $matches);

            return $this->checkLength($matches) >= $config;
        }

        return true;
    }

    /**
     *  Test the password against the configured uppercase requirement.
     *
     *  @return bool
     */
    protected function passwordUppercase(): bool
    {
        $config = config('enraiged.password.uppercase');

        if ($config) {
            $matches = [];
            preg_match_all('/[A-Z]+/', $this->get('password'), $matches);

            return $this->checkLength($matches) >= config('enraiged.password.uppercase');
        }

        return true;
    }

    /**
     *  Validate the password conforms to character case requirements.
     *
     *  @param  \Illuminate\Support\Facades\Validator  $validator
     *  @return $this
     */
    public function validatePasswordCase($validator): self
    {
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

        return $this;
    }

    /**
     *  Validate the password conforms to password history requirements.
     *
     *  @param  \Illuminate\Support\Facades\Validator  $validator
     *  @return $this
     */
    public function validatePasswordHistory($validator): self
    {
        $model = auth_model();
        $user = $model::withTrashed()->findOrFail($this->route()->parameter('user'));

        if ($user->currentPasswordIs($this->get('password'))) {
            $validator->errors()->add('password', $this->messages['password.current']);
        }

        if ($this->passwordHistory($user)) {
            $validator->errors()->add('password', $this->messages['password.history']);
        }

        return $this;
    }

    /**
     *  Validate the password conforms to password length requirements.
     *
     *  @param  \Illuminate\Support\Facades\Validator  $validator
     *  @return $this
     */
    public function validatePasswordLength($validator): self
    {
        if (!$this->passwordMinLength()) {
            $error = __($this->messages['password.length'], [
                'number' => config('enraiged.password.length'),
            ]);

            $validator->errors()->add('password', $error);
        }

        return $this;
    }

    /**
     *  Validate the password conforms to numeric character requirements.
     *
     *  @param  \Illuminate\Support\Facades\Validator  $validator
     *  @return $this
     */
    public function validatePasswordNumeric($validator): self
    {
        if (!$this->passwordNumeric()) {
            $error = __($this->messages['password.numeric'], [
                'number' => config('enraiged.password.numeric'),
                'plural' => config('enraiged.password.numeric') > 1 ? 'numbers' : 'number',
            ]);

            $validator->errors()->add('password', $error);
        }

        return $this;
    }

    /**
     *  Validate the password conforms to special character requirements.
     *
     *  @param  \Illuminate\Support\Facades\Validator  $validator
     *  @return $this
     */
    public function validatePasswordSpecial($validator): self
    {
        if (!$this->passwordSpecial()) {
            $error = __($this->messages['password.special'], [
                'number' => config('enraiged.password.special'),
                'plural' => config('enraiged.password.special') > 1 ? 'characters' : 'character',
            ]);

            $validator->errors()->add('password', $error);
        }

        return $this;
    }
}
