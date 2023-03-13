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
            'alias' => $this->alias(),
            'birthdate' => (mt_rand(0, 1) === 0) ? $this->birthdate() : null,
            'first_name' => $this->faker->firstName(lcfirst(Genders::get($gender))),
            'last_name' => $this->faker->lastName(),
            'gender' => (mt_rand(0, 10) === 0) ? $gender : null,
            'salut' => (mt_rand(0, 5) === 0) ? $salut : null,
        ];
    }

    /**
     *  @return string
     */
    protected function alias()
    {
        $base = (mt_rand(0, 2) === 0)
            ? ucwords($this->faker->word)
            : $this->faker->word;

        return (mt_rand(0, 2) === 0)
            ? $base.(mt_rand(0, 2) === 0 ? mt_rand(1, 255) : ucwords($this->faker->word))
            : null;
    }

    /**
     *  @return string
     */
    protected function birthdate()
    {
        return $this->faker
            ->dateTimeBetween(Carbon::now()->subYears(75), Carbon::now()->subYears(16))
            ->format('Y-m-d');
    }
}
