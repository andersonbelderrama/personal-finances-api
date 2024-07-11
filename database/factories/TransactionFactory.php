<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Pest\Laravel\json;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Transação ' . $this->faker->word(),
            'description' => $this->faker->sentence,
            'value' => $this->faker->randomFloat(2, 0, 2000),
            'payment_date' => $this->faker->dateTimeThisYear('+6 months'),
            'type' => $this->faker->randomElement([1, 2, 3]),
            'is_paid' => $this->faker->boolean,
            'category_id' => Category::inRandomOrder()->first()->id,
            'account_id' => Account::inRandomOrder()->first()->id
        ];
    }
}
