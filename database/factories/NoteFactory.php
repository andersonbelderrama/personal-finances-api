<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Budget;
use App\Models\Debt;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $entities = [
            Debt::class,
            Transaction::class,
            Budget::class,
            Account::class
        ];

        $entity = $this->faker->randomElement($entities);

        $entity_id = $entity::inRandomOrder()->first()->id;

        return [
            'entity_id' => $entity_id,
            'entity_type' => $entity,
            'note' => $this->faker->sentence
        ];
    }
}
