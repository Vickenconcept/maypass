<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PinController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\UserController;
use App\Models\Space;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $spaces =  Space::where('is_available', true)->latest()->get();
    return view('home', compact('spaces'));
})->name('home');


Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::get('forgot-password', [PasswordResetController::class, 'index'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');

    Route::controller(AuthController::class)->group(function () {
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

    Route::post('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
    Route::resource('roles', RoleController::class);

    Route::controller(AuthController::class)->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('auth/register', 'register')->name('auth.register');
    });
});



Route::middleware(['auth', 'permission:create-space'])->group(function () {
    Route::resource('spaces', SpaceController::class)->only(['create', 'store']);
});

Route::middleware(['auth', 'permission:view-space'])->group(function () {
    Route::resource('spaces', SpaceController::class)->only(['index', 'show']);
});

Route::middleware(['auth', 'permission:update-space'])->group(function () {
    Route::resource('spaces', SpaceController::class)->only(['edit', 'update']);
});

Route::middleware(['auth', 'permission:delete-space'])->group(function () {
    Route::resource('spaces', SpaceController::class)->only(['destroy']);
});

Route::middleware(['auth', 'permission:create-category'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['create', 'store']);
});

Route::middleware(['auth', 'permission:view-category'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
});

Route::middleware(['auth', 'permission:update-category'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['edit', 'update']);
});

Route::middleware(['auth', 'permission:delete-category'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['destroy']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/bookings/book/{space}', [BookingController::class, 'book'])->name('bookings.book');
    Route::resource('bookings', BookingController::class);
});

// Route::middleware(['auth', 'permission:view-bookings'])->group(function () {
// Route::get('/bookings/book/{space}', [BookingController::class, 'book'])->name('bookings.book');
// Route::resource('bookings', BookingController::class)->only(['index', 'show']);
// });

Route::middleware(['auth', 'permission:manage-bookings'])->group(function () {
    Route::resource('bookings', BookingController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});

Route::middleware(['auth', 'permission:view-payments'])->group(function () {
    Route::resource('payments', PaymentController::class);
});

Route::middleware(['auth', 'permission:manage-users'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'index')->name('admin.users.index');
        Route::get('/admin/users/{user}/edit', 'edit')->name('admin.users.edit');
        Route::put('/admin/users/{user}', 'update')->name('admin.users.update');
    });
});
