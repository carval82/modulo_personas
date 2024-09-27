<?php

use App\Http\Controllers\PersonasController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckPersonaRegistration;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('personas')->group(function () {
    Route::get('/buscar', [PersonasController::class, 'buscar'])->name('personas.buscar');

    Route::middleware(['auth'])->group(function () {
        Route::get('/', [PersonasController::class, 'index'])->name('personas.index');
        Route::get('/create', [PersonasController::class, 'create'])->name('personas.create');
        Route::post('/', [PersonasController::class, 'store'])->name('personas.store');
        Route::get('/{persona}', [PersonasController::class, 'show'])->name('personas.show');
        Route::get('/{persona}/edit', [PersonasController::class, 'edit'])->name('personas.edit');
        Route::put('/{persona}', [PersonasController::class, 'update'])->name('personas.update');
        Route::delete('/{persona}', [PersonasController::class, 'destroy'])->name('personas.destroy');
    });

    Route::middleware([CheckPersonaRegistration::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Otras rutas protegidas
    });
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Rutas de administrador
});