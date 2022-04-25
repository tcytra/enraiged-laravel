<?php

namespace Enraiged\Accounts\Forms\Builders;

use Enraiged\Accounts\Models\Account;
use Enraiged\Forms\Builders\FormBuilder;

class CreateForm extends FormBuilder
{
    /** @var  bool  Whether or not to apply security assertions to the form builder. */
    protected $assert_security = true;

    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/create-form.json';

    /**
     *  @return object
     */
    public function create()
    {
        $resource = [
            'method' => 'post',
            'route' => 'accounts.store',
        ];

        return $this
            ->populate(new Account)
            ->resource($resource);
    }
}
