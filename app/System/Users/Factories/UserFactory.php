<?php

namespace App\System\Users\Factories;

use App\System\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /** @var  string  The name of the factory's corresponding model. */
    protected $model = User::class;

    /** @var  string  The current password being used by the factory. */
    protected static ?string $password;

    /**
     *  Define the model's default state.
     *
     *  @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];
    }

    /**
     *  Indicate that the model should be inactive.
     *
     *  @return static
     */
    public function inactive()
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     *  Indicate that the model's email address should be unverified.
     *
     *  @return static
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
