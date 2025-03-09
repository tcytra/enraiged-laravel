<?php

namespace App\System\Users\Factories;

use App\System\Users\Models\VerifiedUser;

class VerifiedUserFactory extends UserFactory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = VerifiedUser::class;
}
