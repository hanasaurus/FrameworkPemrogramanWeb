<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/about', function () {
    return 'Toko POS merupakan aplikasi yang digunakan untuk membantu proses penjualan, pengelolaan produk, dan transaksi toko.';
});