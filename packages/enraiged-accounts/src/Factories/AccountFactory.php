<?php

namespace Enraiged\Accounts\Factories;

use Database\Factories\Auth\UserFactory;
use Enraiged\Accounts\Models\Account;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Enraiged\Accounts\Models\Account>
 */
class AccountFactory extends UserFactory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = Account::class;
}
