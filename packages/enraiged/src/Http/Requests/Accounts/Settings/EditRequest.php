<?php

namespace Enraiged\Http\Requests\Accounts\Settings;

use Enraiged\Accounts\Forms\Builders\UpdateSettingsForm;
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
            $this->form = UpdateSettingsForm::from($this);
        }

        return $this->form;
    }
}
