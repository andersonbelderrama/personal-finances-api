<?php

use App\Models\Debt;
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
        Schema::create('transaction_debts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Debt::class)->constrained();
            $table->foreignIdFor(Transaction::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_debts');
    }
};
