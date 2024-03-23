<?php

use App\Models\RecurrentExpense;
use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_recurrent_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RecurrentExpense::class)->constrained();
            $table->foreignIdFor(Transaction::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_recurrent_expenses');
    }
};
