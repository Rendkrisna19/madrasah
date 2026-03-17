<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Livewire\Frontend\LandingPage;
use App\Livewire\Admin\Akademik\AkademikManager;
use App\Livewire\Guru\AbsensiSantri;
use App\Livewire\Auth\RegisterWaliSantri;
use App\Livewire\WaliSantri\Dashboard as WaliSantriDashboard;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama publik (Landing Page Madrasah)
Route::get('/', LandingPage::class)->name('home');
// --- SMART REDIRECTOR DASHBOARD ---
// Jika user login diarahkan ke /dashboard, sistem akan mengecek rolenya
// dan melempar ke URL yang sesuai.
Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    if ($role === 'admin') return redirect()->route('admin.dashboard');
    if ($role === 'guru') return redirect()->route('guru.dashboard');
    if ($role === 'wali_santri') return redirect()->route('wali-santri.dashboard');

    abort(403, 'Role tidak dikenali.');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/register-wali-santri', RegisterWaliSantri::class)->name('register.walisantri');
// Profil bawaan Breeze (Bisa diakses semua role yang sudah login)
Route::middleware('auth')->group(function () {
    Route::view('/profile', 'profile')->name('profile');
});



/*
|--------------------------------------------------------------------------
| ROLE: ADMIN
|--------------------------------------------------------------------------
*/
// Prefix '/admin' akan otomatis ditambahkan ke URL
// Name 'admin.' akan otomatis ditambahkan ke nama route
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
    Route::get('/cms', \App\Livewire\Admin\Cms\CmsManager::class)->name('cms');
    Route::get('/akademik', AkademikManager::class)->name('akademik');
    Route::get('/ppdb', \App\Livewire\Admin\Ppdb\PpdbManager::class)->name('ppdb');
    Route::get('/pengguna', \App\Livewire\Admin\Pengguna\PenggunaManager::class)->name('users');
});

/*
|--------------------------------------------------------------------------
| ROLE: GURU
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {

    Route::get('/dashboard', \App\Livewire\Guru\Dashboard::class)->name('dashboard');
    Route::get('/jadwal', \App\Livewire\Guru\JadwalMengajar::class)->name('jadwal');
    Route::get('/absensi', AbsensiSantri::class)->name('absensi');
});

/*
|--------------------------------------------------------------------------
| ROLE: WALI SANTRI
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:wali_santri'])->prefix('wali-santri')->name('wali-santri.')->group(function () {

    // Path menjadi '/wali-santri/dashboard'
    // Name menjadi 'wali-santri.dashboard' (Sesuai dengan Smart Redirector)
    Route::get('/dashboard', WaliSantriDashboard::class)->name('dashboard');
    Route::get('/ppdb', \App\Livewire\WaliSantri\FormPpdb::class)->name('ppdb');
    Route::get('/santri', \App\Livewire\WaliSantri\DataSantri::class)->name('santri');
});
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');

require __DIR__ . '/auth.php';
