<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

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





Route::get('/login', [LoginController::class, 'loginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'loginUser'])->name('auth.user');
Route::any('/logout', [LoginController::class, 'logoutUser'])->middleware('auth')->name('logout');

Route::get('/register', [RegisterController::class, 'registerForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('user.store');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'AdminDashboardView'])->name('admin.dashboard')->middleware('admin');
Route::patch('admin/dashboard/{id}/update', [AdminDashboardController::class, 'UpdateUser'])->name('user.update');
Route::delete('/admin/dashboard/{id}', [AdminDashboardController::class, 'DeleteUser'])->name('user.delete');

Route::get('/dashboard', [UserDashboardController::class, 'UserDashboard'])->name('user.dashboard')->middleware('auth');
Route::post('/dashboard', [\App\Http\Controllers\IncomeExpensesController::class, 'AddIncomeExpenses'])->name('income_expenses.store');

Route::get('/dashboard/filter', [UserDashboardController::class, 'filter'])->name('dashboard.filter');
