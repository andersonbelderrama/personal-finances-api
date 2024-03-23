<?php

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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->tinyInteger('priority');
            $table->tinyInteger('status')->default(1);
            $table->decimal('debt_value', 10, 2);
            $table->decimal('negotiated_value', 10, 2)->nullable();
            $table->decimal('paid_value', 10, 2)->nullable();
            $table->date('payment_date')->nullable();
            $table->date('due_date')->nullable();
            $table->tinyInteger('payment_method')->nullable();
            $table->tinyInteger('installments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
