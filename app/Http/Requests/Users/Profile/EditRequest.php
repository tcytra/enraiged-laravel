<?php

namespace App\Http\Requests\Users\Profile;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Users\Forms\Builders\UpdateProfileForm;

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
