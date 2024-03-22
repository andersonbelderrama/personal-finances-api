<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Orçamento ' . $this->faker->word,
            'description' => $this->faker->sentence,
            'limit_value' => $this->faker->randomFloat(2, 500, 1000),
            'used_value' => $this->faker->randomFloat(2, 0, 500),
            'type' => $this->faker->randomElement([1, 2]),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
