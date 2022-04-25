<?php

namespace Database\Factories\Auth;

use App\Auth\User;
use Enraiged\Roles\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Auth\User>
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
            'role_id' => Role::lowest()->id,
            'email' => $this->faker->unique()->safeEmail(),
            'verified_at' => now(),
            'password' => bcrypt(Str::random(10)),
            'remember_token' => Str::random(10),
            'is_active' => true,
            'is_hidden' => false,
            'is_protected' => false,
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
