<?php

namespace Enraiged\Profiles\Factories;

use Enraiged\Profiles\Enums\Genders;
use Enraiged\Profiles\Enums\Saluts;
use Enraiged\Profiles\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'alias' => $this->alias(),
            'first_name' => $this->faker->firstName(lcfirst(Genders::get($gender))),
            'last_name' => $this->faker->lastName(),
            'gender' => (mt_rand(0, 10) === 0) ? $gender : null, // 10% chance
            'salut' => (mt_rand(0, 5) === 0) ? $salut : null, // 20% chance
        ];
    }

    protected function alias()
    {
        $base = (mt_rand(0, 2) === 0)
            ? ucwords($this->faker->word)
            : $this->faker->word;

        return (mt_rand(0, 2) === 0)
            ? $base.(mt_rand(0, 2) === 0 ? mt_rand(1, 255) : ucwords($this->faker->word))
            : null;
    }
}
