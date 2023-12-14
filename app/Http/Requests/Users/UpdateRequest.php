<?php

namespace App\Http\Requests\Users;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Users\Forms\Validation\Messages;
use Enraiged\Users\Forms\Validation\Passwords;
use Enraiged\Users\Forms\Validation\Rules;

class UpdateRequest extends FormRequest
{
    use Messages, Passwords, Rules;

    /**
     *  Form and return a success message for this request.
     *
     *  @return string
     */
    public function successMessage(): string
    {
        if ($this->route()->hasParameter('attribute')) {
            $attribute = $this->route()->parameter('attribute');

            return ucwords("{$attribute} Updated");
        }

        return 'User Updated';
    }
}
