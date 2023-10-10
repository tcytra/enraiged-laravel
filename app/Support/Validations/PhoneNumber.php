<?php

namespace App\Support\Validations;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    /**
     *  Run the validation rule.
     *
     *  @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $number = preg_replace('/[^\d]/', '', $value);

        if (!preg_match('/^(\d{10}|\d{11})$/', $number)) {
            $fail('The :attribute field must be a valid phone number.');

            // $fail('validation.phonenumber')->translate();
        }
    }
}
