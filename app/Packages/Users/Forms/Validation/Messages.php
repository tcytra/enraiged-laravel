<?php

namespace App\Packages\Users\Forms\Validation;

trait Messages
{
    /**
     *  Return the request success message.
     *
     *  @return string
     */
    public function message(): string
    {
        if (strtolower($this->method()) === 'post') {
            return 'The user has been created.';
        }

        return $this->attribute
            ? __('The user :attribute has been updated.', ['attribute' => $this->attribute])
            : __(
                $this->user()->id === $this->id
                    ? 'Your account has been updated.'
                    : 'The user has been updated.'
            );
    }
}
