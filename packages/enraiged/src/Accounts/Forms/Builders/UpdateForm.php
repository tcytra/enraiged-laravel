<?php

namespace Enraiged\Accounts\Forms\Builders;

use Enraiged\Accounts\Models\Account;
use Enraiged\Forms\Builders\FormBuilder;

class UpdateForm extends FormBuilder
{
    /** @var  bool  Whether or not to apply security assertions to the form builder. */
    protected $assert_security = true;

    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/update-form.json';

    /**
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return object
     */
    public function edit(Account $account)
    {
        $resource = [
            'id' => $account->id,
            'method' => 'patch',
            'route' => 'accounts.update',
            // 'params' => ['account' => $account->id], // params or id
        ];

        return $this
            ->populate($account)
            ->resource($resource)
            ->template();
    }
}
