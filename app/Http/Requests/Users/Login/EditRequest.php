<?php

namespace App\Http\Requests\Users\Login;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Users\Forms\Builders\UpdateLoginForm;

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
