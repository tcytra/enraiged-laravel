<?php

namespace App\Packages\Users\Factories;

use App\Packages\Profiles\Models\Profile;
use App\Packages\Users\Models\User;
use Enraiged\Users\Factories\UserFactory as Factory;

class UserFactory extends Factory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = User::class;

    /** @var  string  The name of the factory's corresponding profile model. */
    protected $profile = Profile::class;
}
