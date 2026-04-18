<?php

namespace App\Packages\Users\Factories;

use App\Packages\Users\Models\VerifiedUser;

class VerifiedUserFactory extends UserFactory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = VerifiedUser::class;
}
