<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengelolaController as AdminPengelolaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PengelolaController;
use App\Http\Controllers\ProfileController;
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

    // Manajemen Review
    Route::resource('review', \App\Http\Controllers\Admin\ReviewController::class)->only(['index', 'show', 'destroy']);

});

// PENGELOLA ROUTES
Route::prefix('pengelola')->name('pengelola.')->middleware(['auth', 'role:pengelola'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Pengelola\DashboardController::class, 'index'])->name('dashboard');

    // Profile Usaha
    Route::get('/profile', [\App\Http\Controllers\Pengelola\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [\App\Http\Controllers\Pengelola\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Pengelola\ProfileController::class, 'update'])->name('profile.update');

    // Highlights & Fasilitas
    Route::resource('highlight', \App\Http\Controllers\Pengelola\HighlightController::class)->except(['create', 'edit', 'show']);
    Route::resource('fasilitas', \App\Http\Controllers\Pengelola\FasilitasController::class)->except(['create', 'edit', 'show']);

    // Transaksi Manager
    Route::get('/transaksi', [\App\Http\Controllers\Pengelola\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [\App\Http\Controllers\Pengelola\TransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('/transaksi/{id}/approve', [\App\Http\Controllers\Pengelola\TransaksiController::class, 'approve'])->name('transaksi.approve');
    Route::post('/transaksi/{id}/reject', [\App\Http\Controllers\Pengelola\TransaksiController::class, 'reject'])->name('transaksi.reject');

    // review
    Route::get('/review', [\App\Http\Controllers\Pengelola\ReviewController::class, 'index'])->name('review.index');

    // Cek Tiket
    Route::get('/cek-tiket', [\App\Http\Controllers\Pengelola\CekTiketController::class, 'index'])->name('cek-tiket.index');
    Route::post('/cek-tiket/check', [\App\Http\Controllers\Pengelola\CekTiketController::class, 'check'])->name('cek-tiket.check');
    Route::post('/cek-tiket/{id}/scan', [\App\Http\Controllers\Pengelola\CekTiketController::class, 'markScanned'])->name('cek-tiket.scan');
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('onboarding');
Route::get('/destinasi', [\App\Http\Controllers\HomeController::class, 'showmore'])->name('destinasi.showmore');
Route::get('/destinasi/{id}', [\App\Http\Controllers\HomeController::class, 'show'])->name('destinasi.show');
Route::get('/destinasi/ulasan/{id}', [\App\Http\Controllers\UlasanController::class, 'show'])->name('ulasan.show');

// Public Transaction Routes
Route::get('/destinasi/{id}/pesan', [\App\Http\Controllers\TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/destinasi/{id}/pesan', [\App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}/pembayaran', [\App\Http\Controllers\TransaksiController::class, 'payment'])->name('transaksi.payment');
Route::post('/transaksi/{id}/bayar', [\App\Http\Controllers\TransaksiController::class, 'processPayment'])->name('transaksi.processPayment');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/riwayat', [\App\Http\Controllers\TransaksiController::class, 'history'])->name('profile.history');
    Route::get('/profile/riwayat/{id}', [\App\Http\Controllers\TransaksiController::class, 'showDetail'])->name('detail.history');
    Route::get('/profile/riwayat/tiket/{id}', [\App\Http\Controllers\TransaksiController::class, 'showTiket'])->name('show.tiket');
    Route::get('/profile/riwayat/tiket/scan', [\App\Http\Controllers\TransaksiController::class, 'scanTiket'])->name('scan.tiket');

    // Pengajuan Pengelola (untuk user biasa)
    Route::get('/profile/pengajuan', [PengelolaController::class, 'index'])->name('pengelola.index');
    Route::get('/profile/pengajuan/create', [PengelolaController::class, 'create'])->name('pengelola.create');
    Route::post('/profile/pengajuan', [PengelolaController::class, 'store'])->name('pengelola.store');
    Route::get('/profile/pengajuan/edit', [PengelolaController::class, 'edit'])->name('pengelola.edit');
    Route::put('/profile/pengajuan', [PengelolaController::class, 'update'])->name('pengelola.update');

    // API untuk dropdown desa berdasarkan kecamatan
    Route::get('/api/desa/{kecamatan_id}', [PengelolaController::class, 'getDesa']);

    Route::get('/destinasi/ulasan/{id}/store', [\App\Http\Controllers\UlasanController::class, 'index'])->name('ulasan.index');
    Route::post('/destinasi/ulasan/{id}/store', [\App\Http\Controllers\UlasanController::class, 'store'])->name('ulasan.store');

});

require __DIR__ . '/auth.php';
