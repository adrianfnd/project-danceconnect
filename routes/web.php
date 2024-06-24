<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
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
    // Studio routes
    Route::get('/studios', [StudioAdminController::class, 'index'])->name('admin.studios.index');
    Route::get('/studios-schedules', [StudioAdminController::class, 'schedules'])->name('admin.studios.schedules');
    Route::get('/studios-{uuid}', [StudioAdminController::class, 'schedule'])->name('admin.studios.schedule');

    // Tutor routes
    Route::get('/tutors', [TutorAdminController::class, 'index'])->name('admin.tutors.index');
    Route::get('/tutors-classes', [TutorAdminController::class, 'classes'])->name('admin.tutors.classes');
    Route::get('/tutors-users', [TutorAdminController::class, 'users'])->name('admin.tutors.users');
    Route::get('/tutors-classes-{uuid}', [TutorAdminController::class, 'classSchedule'])->name('admin.tutors.class_schedule');

    // Transaction routes
    Route::get('/transactions', [TransactionAdminController::class, 'index'])->name('admin.transactions.index');
    Route::get('/transactions-{uuid}', [TransactionAdminController::class, 'show'])->name('admin.transactions.show');
});

// Costumer routes
Route::middleware(['auth', 'role:costumer'])->group(function () {
    
});
