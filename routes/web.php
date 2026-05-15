<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\TechnicienController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route pour servir les images
Route::get('/image/{path}', [ImageController::class, 'serve'])->name('image.serve')->where('path', '.*');

Route::resource('vehicules', VehiculeController::class);
Route::resource('techniciens', TechnicienController::class);
// Route::resource('reparations', ReparationController::class);
Route::get('reparations', [ReparationController::class, 'index'])->name('reparations.index');
Route::get('reparations/{reparation}', [ReparationController::class, 'show'])->name('reparations.show');
Route::get('/vehicules/{vehicule}/reparations/create', [ReparationController::class, 'create'])->name('reparations.create');
Route::post('/reparations', [ReparationController::class, 'store'])->name('reparations.store');
Route::get('reparations/{reparation}/edit', [ReparationController::class, 'edit'])->name('reparations.edit');
Route::put('reparations/{reparation}', [ReparationController::class, 'update'])->name('reparations.update');
Route::delete('reparations/{reparation}', [ReparationController::class, 'destroy'])->name('reparations.destroy');
