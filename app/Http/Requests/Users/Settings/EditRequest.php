<?php

namespace App\Http\Requests\Users\Settings;

use Enraiged\Forms\Requests\FormRequest;
use Enraiged\Users\Forms\Builders\UpdateSettingsForm;

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
