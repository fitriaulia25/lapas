<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AtensiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Exports\AgendaExport;
use Illuminate\Support\Facades\Auth;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk otentikasi
Auth::routes();

// Kelompok rute untuk pengguna yang telah login (user biasa)
Route::middleware(['auth'])->group(function () {
    // Rute untuk dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

    // Rute untuk agenda
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
    Route::get('/agenda/export', [AgendaController::class, 'export'])->name('agenda.export');
    // Rute untuk atensi
    Route::prefix('forms')->group(function () {
        Route::resource('atensi', AtensiController::class);
        Route::get('/atensi', [AtensiController::class, 'index'])->name('atensi.index');
        Route::get('/atensi/create', [AtensiController::class, 'create'])->name('forms.atensi.create');
        Route::post('/atensi/store', [AtensiController::class, 'store'])->name('atensi.store');
        Route::get('/atensi/{id}', [AtensiController::class, 'show'])->name('atensi.show');
        Route::get('/atensi/{id}/edit', [AtensiController::class, 'edit'])->name('atensi.edit');
        Route::put('/atensi/{id}', [AtensiController::class, 'update'])->name('atensi.update');
        Route::delete('/atensi/{id}', [AtensiController::class, 'destroy'])->name('atensi.destroy');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Kelompok rute untuk admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Kelompok rute untuk super admin
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/super-admin/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
    // Tambahkan rute super admin lainnya di sini
});

Route::get('/export-agenda', function () {
    $export = new AgendaExport();
    return $export->export();
});

// Rute untuk logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Mengarahkan ke halaman utama
})->name('logout');
