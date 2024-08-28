<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\StudioAdminController;
use App\Http\Controllers\TutorAdminController;
use App\Http\Controllers\TransactionAdminController;
use App\Http\Controllers\DashboardUserController;

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
    return redirect('/userdashboard');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.action');

Route::get('/register', [DashboardUserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [DashboardUserController::class, 'register']);

Route::get('password/reset', [DashboardUserController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [DashboardUserController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [DashboardUserController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [DashboardUserController::class, 'reset'])->name('password.update');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

    // Studio routes
    Route::get('/studios', [StudioAdminController::class, 'index'])->name('studios.index');
    Route::get('/studios-schedules', [StudioAdminController::class, 'schedules'])->name('studios.schedules');
    Route::get('/studios-schedule-{id}', [StudioAdminController::class, 'schedule'])->name('studios.schedule');
    Route::get('/studios/create', [StudioAdminController::class, 'create'])->name('studios.create');
    Route::post('/studios', [StudioAdminController::class, 'store'])->name('studios.store');
    Route::get('/studios-{id}', [StudioAdminController::class, 'show'])->name('studios.show');
    Route::get('/studios/edit-{id}', [StudioAdminController::class, 'edit'])->name('studios.edit');
    Route::put('/studios-{id}', [StudioAdminController::class, 'update'])->name('studios.update');
    Route::delete('/studios-{id}', [StudioAdminController::class, 'destroy'])->name('studios.destroy');

    // Tutor routes
    Route::get('/tutors', [TutorAdminController::class, 'index'])->name('tutors.index');
    Route::get('/tutors-classes-schedules', [TutorAdminController::class, 'schedules'])->name('tutors.classes.schedules');
    Route::get('/tutors-classes-schedule-{id}', [TutorAdminController::class, 'schedule'])->name('tutors.classes.schedule');
    Route::get('/tutors', [TutorAdminController::class, 'index'])->name('tutors.index');
    Route::get('/tutors/create', [TutorAdminController::class, 'create'])->name('tutors.create');
    Route::post('/tutors', [TutorAdminController::class, 'store'])->name('tutors.store');
    Route::get('/tutors-{id}', [TutorAdminController::class, 'show'])->name('tutors.show');
    Route::get('/tutors/edit-{id}', [TutorAdminController::class, 'edit'])->name('tutors.edit');
    Route::put('/tutors-{id}', [TutorAdminController::class, 'update'])->name('tutors.update');
    Route::delete('/tutors-{id}', [TutorAdminController::class, 'destroy'])->name('tutors.destroy');
    Route::get('/classes', [TutorAdminController::class, 'indexClasses'])->name('classes.index');
    Route::get('/classes/create', [TutorAdminController::class, 'createClass'])->name('classes.create');
    Route::post('/classes', [TutorAdminController::class, 'storeClass'])->name('classes.store');
    Route::get('/classes-{id}', [TutorAdminController::class, 'showClass'])->name('classes.show');
    Route::get('/classes/edit-{id}', [TutorAdminController::class, 'editClass'])->name('classes.edit');
    Route::put('/classes-{id}', [TutorAdminController::class, 'updateClass'])->name('classes.update');
    Route::delete('/classes-{id}', [TutorAdminController::class, 'destroyClass'])->name('classes.destroy');
    Route::get('get-tutor-info/{id}', [TutorAdminController::class, 'getTutorInfo']);

    
    // History Transaction routes
    Route::get('/transactions', [TransactionAdminController::class, 'index'])->name('transactions.index');
    Route::get('/transactions-{id}', [TransactionAdminController::class, 'show'])->name('transactions.show');
});

// Costumer routes

// Dashboard routes
Route::get('/userdashboard', [DashboardUserController::class, 'userdashboard'])->name('userdashboard');

// Detail Classes and Studios routes
Route::get('/classes/{id}/detail', [DashboardUserController::class, 'classDetail'])->name('classes.detail');
Route::get('/studios/{id}/detail', [DashboardUserController::class, 'studioDetail'])->name('studios.detail');

Route::middleware(['auth', 'role:customer'])->group(function () {
    // Profile routes
    Route::get('/profile', [DashboardUserController::class, 'showprofile'])->name('profile.show');
    Route::get('/profile/edit', [DashboardUserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [DashboardUserController::class, 'update'])->name('profile.update');

    // Order Class and Studio routes
    Route::post('/classes/{id}/order', [DashboardUserController::class, 'orderClass'])->name('classes.order');
    Route::post('/studios/{id}/order', [DashboardUserController::class, 'orderStudio'])->name('studios.order');
    Route::get('/class-order-invoice-{transaction_id}', [DashboardUserController::class, 'handleClassOrderInvoice'])->name('class-order-invoice');
    Route::get('/studio-order-invoice-{transaction_id}', [DashboardUserController::class, 'handleStudioOrderInvoice'])->name('studio-order-invoice');
    
    // History Transaction routes
    Route::get('/usertransactions', [DashboardUserController::class, 'transactionuser'])->name('usertransactions.index');
    Route::get('/usertransactions-{id}', [DashboardUserController::class, 'show'])->name('usertransactions.show');
});
