<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('accounts', AccountController::class);
    Route::apiResource('categories', CategoryController::class);
});
