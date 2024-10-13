<?php

namespace Enraiged\Users\Factories;

use Enraiged\Users\Models\VerifiedUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Enraiged\Users\Models\VerifiedUser>
 */
class VerifiedUserFactory extends UserFactory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = VerifiedUser::class;
}
