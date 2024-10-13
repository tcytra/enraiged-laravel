<?php

namespace Enraiged\Users\Factories;

use Enraiged\Roles\Models\Role;
use Enraiged\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Enraiged\Users\Models\User>
 */
class UserFactory extends Factory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = User::class;

    /** @var  string  The current password being used by the factory. */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'is_active' => true,
            'is_hidden' => false,
            'is_protected' => false,
            'password' => static::$password ??= Hash::make('password'),
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
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'verified_at' => null,
        ]);
    }
}
