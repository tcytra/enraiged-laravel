<?php

namespace Enraiged\Http\Requests\Accounts\Profile;

use Enraiged\Accounts\Forms\Builders\UpdateProfileForm;
use Enraiged\Forms\Requests\FormRequest;

class EditRequest extends FormRequest
{
    /**
     *  Create and return a FormBuilder from the current Request.
     *
     *  @return \Enraiged\Forms\Builders\FormBuilder
     */
    public function form()
    {
        if (!$this->form) {
            $this->form = UpdateProfileForm::from($this);
        }

        return $this->form;
    }
}
