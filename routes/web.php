<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Livewire\EmployeeManager; // 1. Agregamos el componente

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas nuevas para crear clientes
Route::get('nuevo-cliente', [ClientController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('clients.create');

Route::post('nuevo-cliente', [ClientController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('clients.store');

// 2. Agregamos la ruta de empleados aquí
Route::get('empleados', EmployeeManager::class)
    ->middleware(['auth', 'verified'])
    ->name('employees');

require __DIR__.'/settings.php';