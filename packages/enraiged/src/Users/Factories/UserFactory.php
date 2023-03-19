<?php

namespace Enraiged\Users\Factories;

use Enraiged\Roles\Models\Role;
use Enraiged\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Enraiged\Users\Models\User>
 */
class UserFactory extends Factory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'is_active' => true,
            'is_hidden' => false,
            'is_protected' => false,
            'password' => bcrypt(Str::random(10)),
            'remember_token' => Str::random(10),
            'role_id' => Role::whereNot('name', 'Administrator')->inRandomOrder()->first()->id,
            'verified_at' => now(),
        ];
    }

    /**
     * Indicate that the model should be inactive.
     *
     * @return static
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'verified_at' => null,
            ];
        });
    }
}
