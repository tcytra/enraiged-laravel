<?php

namespace App\Packages\Users\Forms;

use Enraiged\Forms\Builders\FormBuilder;

class UserForm extends FormBuilder
{
    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/Templates/user-form.json';
}
