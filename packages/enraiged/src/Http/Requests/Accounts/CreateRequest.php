<?php

namespace Enraiged\Http\Requests\Accounts;

use Enraiged\Accounts\Forms\Builders\CreateForm;
use Enraiged\Accounts\Forms\Validation\Messages;
use Enraiged\Accounts\Forms\Validation\Rules;
use Enraiged\Forms\Requests\FormRequest;

class CreateRequest extends FormRequest
{
    use Messages, Rules;

    /**
     *  Create and return a FormBuilder from the current Request.
     *
     *  @return \Enraiged\Forms\Builders\FormBuilder
     */
    public function form()
    {
        if (!$this->form) {
            $this->form = CreateForm::from($this);
        }

        return $this->form;
    }

    /**
     *  Get the validation rules that apply to the request.
     *
     *  @return array
     */
    public function rules()
    {
        return collect($this->rules)
            ->only(['email', 'password', 'role_id'])
            ->merge(['name' => 'required|string'])
            ->toArray();
    }
}
