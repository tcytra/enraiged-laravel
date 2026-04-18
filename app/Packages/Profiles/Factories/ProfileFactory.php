<?php

namespace App\Packages\Profiles\Factories;

use App\Packages\Profiles\Models\Profile;
use Enraiged\Profiles\Factories\ProfileFactory as Factory;

class ProfileFactory extends Factory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = Profile::class;
}
