<?php

namespace Enraiged\Accounts\Forms\Builders;

use Enraiged\Forms\Builders\FormBuilder;

class UpdateLoginForm extends FormBuilder
{
    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/login-form.json';
}
