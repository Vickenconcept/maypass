<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PinController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\UserController;
use App\Models\Space;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $spaces =  Space::where('is_available', true)->get();
    return view('home', compact('spaces'));
})->name('home');


Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::get('forgot-password', [PasswordResetController::class, 'index'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');

    Route::controller(AuthController::class)->group(function () {
        // Route::get('register', 'showRegistrationForm')->name('register');
        // Route::post('auth/register', 'register')->name('auth.register');
        Route::post('auth/login', 'login')->name('auth.login');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {

        return view('dashboard');
    })->name('dashboard');


    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::middleware(['auth', 'role:super-admin'])->group(function () {

    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'index')->name('admin.users.index');
        Route::get('/admin/users/{user}/edit', 'edit')->name('admin.users.edit');
        Route::put('/admin/users/{user}', 'update')->name('admin.users.update');
    });
    Route::resource('spaces', SpaceController::class);

    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles',  'index')->name('roles.index');
        Route::get('/roles/create', 'create')->name('roles.create');
        Route::post('roles', 'store')->name('roles.store');
        Route::post('/roles/{role}/permissions', 'updatePermissions')->name('roles.permissions.update');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('auth/register', 'register')->name('auth.register');
    });
});


Route::middleware(['auth', 'role:admin|super-admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth', 'permission:view-bookings'])->group(function () {
    Route::get('/bookings/book/{space}', [BookingController::class, 'book'])->name('bookings.book');
    Route::resource('bookings', BookingController::class);
});
