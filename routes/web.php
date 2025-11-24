<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PengelolaController as AdminPengelolaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengelolaController;
use Illuminate\Support\Facades\Route;

// REDIRECT ROUTES
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware('auth')->get('/dashboard', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('pengelola')) {
        return redirect()->route('pengelola.dashboard');
    }
    return redirect()->route('onboarding');
})->name('dashboard');

// ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Manajemen User
    Route::resource('users', UserController::class);
    Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');

    // Manajemen Pengelola
    Route::get('pengelola', [AdminPengelolaController::class, 'index'])->name('pengelola.index');
    Route::get('pengelola/{pengelola}', [AdminPengelolaController::class, 'show'])->name('pengelola.show');
    Route::post('pengelola/{pengelola}/approve', [AdminPengelolaController::class, 'approve'])->name('pengelola.approve');
    Route::post('pengelola/{pengelola}/reject', [AdminPengelolaController::class, 'reject'])->name('pengelola.reject');
    Route::post('pengelola/{pengelola}/block', [AdminPengelolaController::class, 'block'])->name('pengelola.block');
    Route::post('pengelola/{pengelola}/unblock', [AdminPengelolaController::class, 'unblock'])->name('pengelola.unblock');
});

// PENGELOLA ROUTES
Route::prefix('pengelola')->name('pengelola.')->middleware(['auth', 'role:pengelola'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Manajemen User

});

Route::get('/', function () {
    return view('onboarding');
})->name('onboarding');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pengajuan Pengelola (untuk user biasa)
    Route::get('/profile/pengajuan', [PengelolaController::class, 'index'])->name('pengelola.index');
    Route::get('/profile/pengajuan/create', [PengelolaController::class, 'create'])->name('pengelola.create');
    Route::post('/profile/pengajuan', [PengelolaController::class, 'store'])->name('pengelola.store');
    Route::get('/profile/pengajuan/edit', [PengelolaController::class, 'edit'])->name('pengelola.edit');
    Route::put('/profile/pengajuan', [PengelolaController::class, 'update'])->name('pengelola.update');

    // API untuk dropdown desa berdasarkan kecamatan
    Route::get('/api/desa/{kecamatan_id}', [PengelolaController::class, 'getDesa']);
});

require __DIR__ . '/auth.php';
