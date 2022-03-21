<?php

namespace Database\Factories\System\Persons\Models;

use App\System\Persons\Enums\Genders;
use App\System\Persons\Enums\Saluts;
use App\System\Persons\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\System\Persons\Models\Person>
 */
class PersonFactory extends Factory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
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
            'birthdate' => $this->faker->dateTimeBetween(
                    Carbon::now()->subYears(65),
                    Carbon::now()->subYears(18)
                )->format('Y-m-d'),
            'email' => null,
            'first_name' => $this->faker->firstName(lcfirst(Genders::get($gender))),
            'gender' => $gender,
            'last_name' => $this->faker->lastName(),
            'salut' => $salut,
            'phone' => $this->faker->phoneNumber,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function withEmail()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => $this->faker->unique()->safeEmail(),
            ];
        });
    }
}
