<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Debt>
 */
class DebtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $notes = [];

        $numNotes = $this->faker->numberBetween(1, 5);

        for ($i = 0; $i < $numNotes; $i++) {
            $notes[] = [
                'note' => $this->faker->text,
                'date' => $this->faker->dateTime()->format('d-m-Y H:i:s'),
            ];
        }

        return [
            'name' => 'Divida ' . $this->faker->word(),
            'description' => $this->faker->sentence(),
            'priority' => $this->faker->numberBetween(1, 3),
            'status' => $this->faker->numberBetween(1, 3),
            'debt_value' => $this->faker->randomFloat(2, 100, 30000),
            'negotiated_value' => $this->faker->randomFloat(2, 0, 20000),
            'paid_value' => $this->faker->randomFloat(2, 0, 2000),
            'payment_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'payment_method' => $this->faker->numberBetween(1, 3),
            'installments' => $this->faker->numberBetween(1, 12),
        ];
    }
}
