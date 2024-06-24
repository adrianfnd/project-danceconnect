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
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // Studio routes
    Route::get('/studios', [StudioAdminController::class, 'index'])->name('admin.studios.index');
    Route::get('/studios-schedules', [StudioAdminController::class, 'schedules'])->name('admin.studios.schedules');
    Route::get('/studios-{id}', [StudioAdminController::class, 'schedule'])->name('admin.studios.schedule');

    // Tutor routes
    Route::get('/tutors', [TutorAdminController::class, 'index'])->name('admin.tutors.index');
    Route::get('/tutors-classes', [TutorAdminController::class, 'indexClasses'])->name('admin.tutors.classes.index');
    Route::get('/tutors-classes-schedules', [TutorAdminController::class, 'schedules'])->name('admin.tutors.classes.schedules');
    Route::get('/tutors-classes-{id}', [TutorAdminController::class, 'schedule'])->name('admin.tutors.classes.schedule');

    // Transaction routes
    Route::get('/transactions', [TransactionAdminController::class, 'index'])->name('admin.transactions.index');
    Route::get('/transactions-{id}', [TransactionAdminController::class, 'show'])->name('admin.transactions.show');
});

// Costumer routes
Route::middleware(['auth', 'role:costumer'])->group(function () {
    
});
