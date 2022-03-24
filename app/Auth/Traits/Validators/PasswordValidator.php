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
        $config = config('password.uppercase');

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
    protected function passwordSpecial(): bool
    {
        $config = config('password.special');

        if ($config) {
            preg_match_all('/[^\da-zA-Z0-9]+/', $this->get('password'), $matches);

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
}
