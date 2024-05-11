<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\RecurrentExpenseController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('health', function () {
//     return response()->json([
//         'status' => 'ok',
//         'version' => config('app.version'),
// ]);
// })->middleware('auth:sanctum');

Route::get('user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('accounts', AccountController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('debts', DebtController::class);
    Route::apiResource('budgets', BudgetController::class);
    Route::apiResource('recurrent-expenses', RecurrentExpenseController::class);
    Route::apiResource('transactions', TransactionController::class);
});
