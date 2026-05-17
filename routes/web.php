<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\TechnicienController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\AppointmentController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/rendez-vous', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/rendez-vous', [AppointmentController::class, 'store'])->name('appointments.store');

// Route pour servir les images
Route::get('/image/{path}', [ImageController::class, 'serve'])->name('image.serve')->where('path', '.*');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('vehicules', VehiculeController::class);
    Route::resource('techniciens', TechnicienController::class);

    Route::get('reparations', [ReparationController::class, 'index'])->name('reparations.index');
    Route::get('reparations/{reparation}', [ReparationController::class, 'show'])->name('reparations.show');
    Route::get('/vehicules/{vehicule}/reparations/create', [ReparationController::class, 'create'])->name('reparations.create');
    Route::get('/appointments/{appointment}/repair/create', [ReparationController::class, 'createFromAppointment'])->name('appointments.repair.create');
    Route::post('/reparations', [ReparationController::class, 'store'])->name('reparations.store');
    Route::get('reparations/{reparation}/edit', [ReparationController::class, 'edit'])->name('reparations.edit');
    Route::put('reparations/{reparation}', [ReparationController::class, 'update'])->name('reparations.update');
    Route::delete('reparations/{reparation}', [ReparationController::class, 'destroy'])->name('reparations.destroy');

    Route::get('/admin/rendez-vous', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/admin/rendez-vous/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');
});
