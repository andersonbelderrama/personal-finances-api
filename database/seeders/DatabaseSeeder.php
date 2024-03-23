<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Account;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Debt;
use App\Models\Note;
use App\Models\RecurrentExpense;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        User::factory()->create([
            'name' => 'Anderson Belderrama',
            'email' => 'andersonbelderrama@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        Account::factory(4)->create();
        Category::factory(20)->create();
        Debt::factory(30)->create();
        Budget::factory(5)->create();
        RecurrentExpense::factory(10)->create();
        Transaction::factory(100)->create();
        Note::factory(20)->create();

    }
}
