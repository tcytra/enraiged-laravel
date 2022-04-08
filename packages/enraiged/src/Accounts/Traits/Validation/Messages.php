<?php

namespace Enraiged\Accounts\Traits\Validation;

trait Messages
{
    /** @var  array  The custom error messages for the validations. */
    protected $messages = [
        'agree.required' => 'You must agree to check the little box.',
        'email.unique' => 'This email already exists in the system.',
        'password.current' => 'You cannot use the current password.',
        'password.history' => 'You cannot use a recent previous password.',
        'password.length' => 'The password must be at least :number characters.',
        'password.lowercase' => 'There must be at least :number lowercase :plural.',
        'password.numeric' => 'There must be at least :number :plural.',
        'password.special' => 'There must be at least :number special :plural.',
        'password.uppercase' => 'There must be at least :number uppercase :plural.',
    ];
}
