<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Halaman Depan (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// 2. Halaman Dashboard Bawaan Breeze (Opsional, bisa kamu pakai atau abaikan)
Route::get('/dashboard', function () {
    return redirect('/keuangan');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. SEMUA RUTE KEUANGAN (Hanya bisa diakses jika sudah LOGIN)
Route::middleware('auth')->group(function () {
    
    // Halaman Utama Catatan Keuangan
    Route::get('/keuangan', [TransaksiController::class, 'index'])->name('keuangan');
    
    // Proses Tambah Transaksi
    Route::post('/keuangan/tambah', [TransaksiController::class, 'store'])->name('keuangan.tambah');
    
    // Proses Hapus Transaksi
    Route::get('/keuangan/hapus/{id}', [TransaksiController::class, 'destroy'])->name('keuangan.hapus');

    // Rute Profile (Bawaan Breeze untuk ganti password/hapus akun)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Memanggil rute Login, Register, Logout dari Breeze
require __DIR__.'/auth.php';