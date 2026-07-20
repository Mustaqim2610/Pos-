<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', LogoutController::class)->name('logout');

    // Dashboard (semua role bisa akses)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |----------------------------------------------------------------------
    | Admin only
    |----------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {
        Route::resource('categories', CategoryController::class)
            ->except(['show', 'create', 'edit']);

        Route::resource('products', ProductController::class)
            ->except(['show']);

        Route::resource('users', UserController::class)
            ->except(['show']);
    });

    /*
    |----------------------------------------------------------------------
    | Kasir + Admin
    |----------------------------------------------------------------------
    */
    Route::middleware('cashier')->group(function () {
        // Kasir page
        Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
        Route::post('/sales',       [SaleController::class, 'store'])->name('sales.store');

        // Riwayat transaksi
        Route::get('/sales',             [SaleController::class, 'index'])->name('sales.index');
        Route::get('/sales/{sale}/detail', [SaleController::class, 'detail'])->name('sales.detail');

        // Laporan
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

});
