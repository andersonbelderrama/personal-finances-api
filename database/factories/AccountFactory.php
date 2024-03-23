<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Banco " . $this->faker->word(),
            'branch' => $this->faker->randomNumber(4, true),
            'account_number' => $this->faker->randomNumber(6, true),
            'active' => $this->faker->boolean,
            'type' => $this->faker->numberBetween(1, 2),
            'balance' => $this->faker->numberBetween(1, 1000),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
