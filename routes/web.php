<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\StudioAdminController;
use App\Http\Controllers\TutorAdminController;
use App\Http\Controllers\TransactionAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.action');

// Admin routes
Route::middleware(['auth'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

    // Studio routes
    Route::get('/studios', [StudioAdminController::class, 'index'])->name('studios.index');
    Route::get('/studios-schedules', [StudioAdminController::class, 'schedules'])->name('studios.schedules');
    Route::get('/studios-{id}', [StudioAdminController::class, 'schedule'])->name('studios.schedule');
    Route::get('/studios/create', [StudioAdminController::class, 'create'])->name('studios.create');
    Route::post('/studios', [StudioAdminController::class, 'store'])->name('studios.store');
    Route::get('/studios-{id}', [StudioAdminController::class, 'show'])->name('studios.show');
    Route::get('/studios/edit-{id}', [StudioAdminController::class, 'edit'])->name('studios.edit');
    Route::put('/studios-{id}', [StudioAdminController::class, 'update'])->name('studios.update');
    Route::delete('/studios-{id}', [StudioAdminController::class, 'destroy'])->name('studios.destroy');

    // Tutor routes
    Route::get('/tutors', [TutorAdminController::class, 'index'])->name('tutors.index');
    Route::get('/tutors-classes', [TutorAdminController::class, 'indexClasses'])->name('tutors.classes.index');
    Route::get('/tutors-classes-schedules', [TutorAdminController::class, 'schedules'])->name('tutors.classes.schedules');
    Route::get('/tutors-classes-{id}', [TutorAdminController::class, 'schedule'])->name('tutors.classes.schedule');
    Route::get('/tutors', [TutorAdminController::class, 'index'])->name('tutors.index');
    Route::get('/tutors/create', [TutorAdminController::class, 'create'])->name('tutors.create');
    Route::post('/tutors', [TutorAdminController::class, 'store'])->name('tutors.store');
    Route::get('/tutors-{id}', [TutorAdminController::class, 'show'])->name('tutors.show');
    Route::get('/tutors/edit-{id}', [TutorAdminController::class, 'edit'])->name('tutors.edit');
    Route::put('/tutors-{id}', [TutorAdminController::class, 'update'])->name('tutors.update');
    Route::delete('/tutors-{id}', [TutorAdminController::class, 'destroy'])->name('tutors.destroy');

    // Transaction routes
    Route::get('/transactions', [TransactionAdminController::class, 'index'])->name('transactions.index');
    Route::get('/transactions-{id}', [TransactionAdminController::class, 'show'])->name('transactions.show');
});

// Costumer routes
Route::middleware(['auth', 'role:costumer'])->group(function () {
    
});
