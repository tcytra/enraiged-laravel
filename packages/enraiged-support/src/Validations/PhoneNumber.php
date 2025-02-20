<?php

namespace Enraiged\Support\Validations;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    /** @var  string  The validation failure message. */
    protected string $message = 'The :attribute field must be a valid phone number.';

    /**
     *  Run the validation rule.
     *
     *  @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^([0-9\s\-\+\(\)]*)$/', $value) || strlen($value) < 10) {
            $fail($this->message);
        }

        $number = preg_replace('/[^\d]/', '', $value);

        if (!preg_match('/^(\d{10}|\d{11})$/', $number)) {
            $fail($this->message);

            // $fail('validation.phonenumber')->translate();
        }
    }
}
