<?php

namespace Enraiged\Users\Forms\Builders;

use Enraiged\Forms\Builders\FormBuilder;

class UpdateSettingsForm extends FormBuilder
{
    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/settings-form.json';
}
