<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('registration', [AuthController::class, 'registration'])->name('registration');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('users', [UserController::class, 'update'])->name('user.update');
});
