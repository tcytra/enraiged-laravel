<?php

namespace Enraiged\Accounts\Forms\Builders;

use Enraiged\Accounts\Models\Account;
use Enraiged\Forms\Builders\FormBuilder;

class UpdateLoginForm extends FormBuilder
{
    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/login-form.json';

    /**
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return object
     */
    public function edit(Account $account)
    {
        $resource = [
            'id' => $account->id,
            'method' => 'patch',
            'route' => 'accounts.login.update',
        ];

        return $this
            ->populate($account)
            ->resource($resource)
            ->template();
    }
}
