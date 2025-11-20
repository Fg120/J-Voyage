<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\delete;

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::post('users/{id}/restore', [\App\Http\Controllers\Admin\UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{id}/force-delete', [\App\Http\Controllers\Admin\UserController::class, 'forceDelete'])->name('users.force-delete');
});

Route::get('/', function () {
    return view('onboarding');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
