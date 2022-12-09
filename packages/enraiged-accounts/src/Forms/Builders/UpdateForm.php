<?php

namespace Enraiged\Accounts\Forms\Builders;

use Enraiged\Forms\Builders\FormBuilder;

class UpdateForm extends FormBuilder
{
    /** @var  bool  Whether or not to apply security assertions to the form builder. */
    protected $assert_security = true;

    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/update-form.json';
}
