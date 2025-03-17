<?php

namespace App\System\Passwords\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordRules implements DataAwareRule, ValidationRule
{
    /** @var  array  All of the data under validation. */
    protected $data = [];

    /**
     *  Run the validation rule.
     *
     *  @param  string  $attribute
     *  @param  mixed   $value
     *  @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *  @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        (bool) $this
            ->setLocale()
            ->checkCurrent($value, $fail)
            ->checkHistory($value, $fail)
            ->checkLength($value, $fail)
            ->checkLowercase($value, $fail)
            ->checkSpecial($value, $fail)
            ->checkUppercase($value, $fail);
    }

    /**
     *  Test the password against the current authenticated user password, if possible.
     *
     *  @param  mixed   $value
     *  @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *  @return $this
     */
    protected function checkCurrent(mixed $value, Closure $fail)
    {
        $config = config('enraiged.passwords.current') === true;

        if ($config && Auth::check() && Auth::user()->currentPasswordIs($value)) {
            $fail(__('passwords.current'));
        }

        return $this;
    }

    /**
     *  Test the password history against the configured requirement.
     *
     *  @param  mixed   $value
     *  @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *  @return $this
     */
    protected function checkHistory(mixed $value, Closure $fail): self
    {
        $count = config('enraiged.passwords.history');

        if ($count === true) {
            $count = 1;
        }

        if (preg_match('/^\d+$/', $count) && Auth::check()) {
            $exists = Auth::user()->passwordHistory()
                ->orderBy('created_at', 'desc')
                ->limit($count)
                ->pluck('password')
                ->contains(fn ($password)
                    => Hash::check($value, $password));

            if ($exists) {
                $fail(trans_choice('passwords.history', $count));
            }
        }

        return $this;
    }

    /**
     *  Test the password against the configured minimum length requirement.
     *
     *  @param  mixed   $value
     *  @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *  @return $this
     */
    protected function checkLength(mixed $value, Closure $fail): self
    {
        $count = (int) config('enraiged.passwords.length');

        if ($count && strlen($value) < $count) {
            $fail(trans_choice('passwords.length', $count));
        }

        return $this;
    }

    /**
     *  Test the password against the configured lowercase requirement.
     *
     *  @param  mixed   $value
     *  @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *  @return $this
     */
    protected function checkLowercase(mixed $value, Closure $fail): self
    {
        $count = (int) config('enraiged.passwords.lowercase');
        $chars = preg_replace('/[^a-z]/', '', $value);

        if ($count && strlen($chars) < $count) {
            $fail(trans_choice('passwords.lowercase', $count));
        }

        return $this;
    }

    /**
     *  Test the password against the configured lowercase requirement.
     *
     *  @param  mixed   $value
     *  @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *  @return $this
     */
    protected function checkNumeric(mixed $value, Closure $fail): self
    {
        $count = (int) config('enraiged.passwords.numeric');
        $chars = preg_replace('/[^0-9]/', '', $value);

        if ($count && strlen($chars) < $count) {
            $fail(trans_choice('passwords.numeric', $count));
        }

        return $this;
    }

    /**
     *  Test the password against the configured special character requirement.
     *
     *  @param  mixed   $value
     *  @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *  @return $this
     */
    protected function checkSpecial(mixed $value, Closure $fail): self
    {
        $count = (int) config('enraiged.passwords.special');
        $chars = preg_replace('/[A-Za-z0-9]/', '', $value);

        if ($count && strlen($chars) < $count) {
            $fail(trans_choice('passwords.special', $count));
        }

        return $this;
    }

    /**
     *  Test the password against the configured uppercase requirement.
     *
     *  @param  mixed   $value
     *  @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *  @return $this
     */
    protected function checkUppercase(mixed $value, Closure $fail): self
    {
        $count = (int) config('enraiged.passwords.uppercase');
        $chars = preg_replace('/[^A-Z]/', '', $value);

        if ($count && strlen($chars) < $count) {
            $fail(trans_choice('passwords.uppercase', $count));
        }

        return $this;
    }

    /**
     *  Set the data under validation.
     *
     *  @param  array  $data
     *  @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     *  Set the locale for the validation messages from the provided data, if possible.
     *
     *  @return $this
     */
    public function setLocale(): self
    {
        if (key_exists('locale', $this->data)) {
            app()->setLocale($this->data['locale']);
        }

        return $this;
    }
}
