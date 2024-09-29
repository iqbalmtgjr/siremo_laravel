<?php

use App\Livewire\Dashboard;
use App\Livewire\Mitra\IndexMitra;
use Illuminate\Support\Facades\Route;
use App\Livewire\Riwayat\IndexRiwayat;
use App\Livewire\Pengguna\IndexPengguna;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfilController;
use App\Livewire\Hargasewa\IndexHargaSewa;
use App\Livewire\Kendaraan\IndexKendaraan;
use App\Livewire\Kritik\IndexKritik;
use App\Livewire\Transaksi\IndexTransaksi;
use App\Livewire\Penggunamitra\IndexPenggunaMitra;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', Dashboard::class);

    Route::get('/mitra', IndexMitra::class);
    Route::get('/hargasewa', IndexHargaSewa::class);
    Route::get('/kendaraan', IndexKendaraan::class);
    Route::get('/pengguna', IndexPengguna::class);
    Route::get('/penggunamitra', IndexPenggunaMitra::class);
    Route::get('/transaksi', IndexTransaksi::class);
    Route::get('/riwayat', IndexRiwayat::class);

    Route::get('/profil/{id}', [ProfilController::class, 'index']);
    Route::put('/profil/{id}', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/{id}/password', [ProfilController::class, 'updatePassword'])->name('profil.password');

    Route::get('/kritik', IndexKritik::class);
    Route::post('/kritiksaran', [ProfilController::class, 'storeKritikSaran'])->name('kritiksaran.store');
});
