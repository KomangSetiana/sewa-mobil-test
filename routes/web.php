<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Models\Car;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'cars' => Car::latest()->take(4)->get()
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/cars-all', [CarController::class, 'indexAll'])->name('cars.index.all');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/edit/{id}', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{id}', [CarController::class, 'update'])->name('cars.update');
    Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');
    Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');


    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/rentals/create/{id}', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rentals/{id}', [RentalController::class, 'store'])->name('rentals.store');
    Route::put('/rentals/{id}', [RentalController::class, 'returnCar'])->name('rentals.returnCar');
});





require __DIR__ . '/auth.php';
