<?php

namespace Enraiged\Profiles\Factories;

use Enraiged\Profiles\Enums\Genders;
use Enraiged\Profiles\Enums\Saluts;
use Enraiged\Profiles\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Enraiged\Profiles\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = Profile::class;

    /**
     *  Define the model's default state.
     *
     *  @return array
     */
    public function definition()
    {
        $salut = Saluts::keys()->random();
        $gender = $salut === Saluts::Mr
            ? Genders::Male
            : (in_array($salut, [Saluts::Miss, Saluts::Mrs, Saluts::Ms])
                ? Genders::Female
                : Genders::keys()->random());

        return [
            'first_name' => $this->faker->firstName(lcfirst(Genders::get($gender))),
            'last_name' => $this->faker->lastName(),
            'birthdate' => (mt_rand(0, 2) === 0) ? $this->birthdate() : null, // 50% chance
            'gender' => (mt_rand(0, 10) === 0) ? $gender : null, // 10% chance
            'salut' => (mt_rand(0, 5) === 0) ? $salut : null, // 20% chance
        ];
    }

    protected function birthdate()
    {
        return $this->faker
            ->dateTimeBetween(Carbon::now()->subYears(75), Carbon::now()->subYears(16))
            ->format('Y-m-d');
    }
}
