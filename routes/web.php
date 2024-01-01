<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ProfileController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [AuthController::class, 'register_view'])->name('register-form');
Route::post('/register', [AuthController::class, 'registered'])->name('register');

Route::get('/login-form', [AuthController::class, 'showLoginForm'])->name('loginform');
Route::post('/login', [AuthController::class, 'user_login'])->name('login');


Route::get('/verify', [OtpController::class, 'showVerificationForm'])->name('optverify');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verify');

Route::middleware(['otp.auth', 'logUserActivity'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/logout', [DashboardController::class, 'logout'])->name('dashboard.logout');

// Role Management
Route::resource('roles', RoleController::class);

// Permission Management
Route::resource('permissions', PermissionController::class);
// User Management
Route::resource('users', UserController::class);
Route::post('/users/delete-selected', [UserController::class, 'deleteSelected'])->name('users.deleteSelected');
Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');

//activity-logs Management
Route::resource('activity-logs', ActivityLogController::class);

//User Profile Management
Route::get('/profile', [ProfileController::class, 'show'])->name('profileshow');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profileedit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profileupdate');


});






