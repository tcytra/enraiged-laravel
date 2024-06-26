<?php

namespace Enraiged\Users\Forms\Builders;

use Enraiged\Forms\Builders\FormBuilder;

class CreateUser extends FormBuilder
{
    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/create-user.json';
}
