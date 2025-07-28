<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;

// Rutas de autenticación
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Rutas protegidas por autenticación
Route::middleware('auth:sanctum')->group(function () {

    // Rutas para solicitudes de medicamentos
    Route::apiResource('requests', RequestController::class)->only([
        'index',
        'store',
        'show',
        'update',
        'destroy'
    ]);

    // Rutas para medicamentos
    Route::apiResource('medicines', MedicineController::class)->only([
        'index',
        'store',
        'show',
        'update',
        'destroy'
    ]);

    // Rutas para usuarios (solo lectura)
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
});
