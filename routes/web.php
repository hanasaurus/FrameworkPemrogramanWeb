<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ReportController;

//================= AUTH =================//
Route::get('/login', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

//================= DASHBOARD =================//
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

//================= ADMIN =================//
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Master Data
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    // Manajemen User
    Route::resource('users', UserController::class);

    // Laporan Penjualan
    Route::get('/reports/sales', [ReportController::class, 'sales'])
        ->name('report.sales');

    Route::get('/reports/sales/export', [ReportController::class, 'export'])
        ->name('report.export');
});

//================= ADMIN DAN KASIR =================//
Route::middleware(['auth', 'role:admin,kasir'])->group(function () {

    // Point of Sale
    Route::get('/pos', [PosController::class, 'index'])
        ->name('pos.index');

    Route::post('/pos', [PosController::class, 'store'])
        ->name('pos.store');

    // Cetak Struk
    Route::get('/pos/{transaction}/struk', [PosController::class, 'struk'])
        ->name('pos.struk');
});

//================= KHUSUS KASIR =================//
Route::middleware(['auth', 'role:kasir'])->group(function () {

    Route::get('/pos/history', [PosController::class, 'history'])
        ->name('pos.history');
});

//================= TUGAS 2 =================//
Route::get('/about', function () {
    return 'Toko POS merupakan aplikasi yang digunakan untuk membantu proses penjualan, pengelolaan produk, dan transaksi toko.';
});
