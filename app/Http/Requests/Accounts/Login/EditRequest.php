<?php

namespace App\Http\Requests\Accounts\Login;

use Enraiged\Accounts\Forms\Builders\UpdateLoginForm;
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
            $this->form = UpdateLoginForm::from($this);
        }

        return $this->form;
    }
}
