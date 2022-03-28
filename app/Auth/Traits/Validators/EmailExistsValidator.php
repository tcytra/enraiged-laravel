<?php

namespace App\Auth\Traits\Validators;

use App\Auth\User;

trait EmailExistsValidator
{
    /**
     *  @param  string  $value
     *  @return bool
     */
    protected function emailExists($value, $check_username = true): bool
    {
        $builder = User::where('email', $value);

        if ($check_username) {
            $builder->orWhere('username', $value);
        }

        return $builder->count() !== 0;
    }

    /**
     *  Configure the validator instance.
     *
     *  @param  \Illuminate\Validation\Validator  $validator
     *  @return void
     */
	public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->emailExists($this->get('email'))) {
                $validator->errors()->add('email', __($this->messages['email.exists']));
            }
        });
    }
}
