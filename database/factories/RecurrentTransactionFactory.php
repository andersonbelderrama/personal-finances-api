<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecurrentTransaction>
 */
class RecurrentTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Transação Recorrente ' . $this->faker->word,
            'description' => $this->faker->sentence,
            'value' => $this->faker->numberBetween(1, 1000),
            'type' => $this->faker->numberBetween(1, 2),
            'is_paid' => $this->faker->boolean,
            'recurrent_date' => $this->faker->date,
            'recurrence_frequency' => $this->faker->numberBetween(1, 3),
            'category_id' => Category::inRandomOrder()->first()->id
        ];
    }
}
