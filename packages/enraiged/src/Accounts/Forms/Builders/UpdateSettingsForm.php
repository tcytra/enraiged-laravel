<?php

namespace Enraiged\Accounts\Forms\Builders;

use Enraiged\Accounts\Models\Account;
use Enraiged\Forms\Builders\FormBuilder;

class UpdateSettingsForm extends FormBuilder
{
    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/settings-form.json';

    /**
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return object
     */
    public function edit(Account $account)
    {
        $resource = [
            'id' => $account->id,
            'method' => 'patch',
            'route' => 'accounts.settings.update',
        ];

        return $this
            ->populate($account)
            ->resource($resource)
            ->template();
    }
}
