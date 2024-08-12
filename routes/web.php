<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSpaceController;
use App\Models\Space;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');



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
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('notifications.mark-as-read');


    Route::get('/notifications/{id}', function ($id) {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    })->name('notifications.read_one');;

    Route::get('my-spaces', [UserSpaceController::class, 'index'])->name('my.space.index');
    Route::get('/my-spaces/{space}', [UserSpaceController::class, 'show'])->name('my.space.show');
    Route::post('/workspace/{workspace}/add-user', [UserSpaceController::class, 'addUserToWorkspace'])
        ->name('workspace.add-user')
        ->middleware('auth');
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
    Route::post('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
    Route::resource('bookings', BookingController::class);

    Route::view('profile', 'profile')->name('profile');
    Route::post('profile/name', [ProfileController::class, 'changeName'])->name('changeName');
    Route::post('profile/password', [ProfileController::class, 'changePassword'])->name('changePassword');
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
