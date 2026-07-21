<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');

    Route::get('/register',  [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
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

    // Profil (semua role)
    Route::get('/profile',              [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile',              [ProfileController::class, 'updateInfo'])->name('profile.update');
    Route::put('/profile/password',     [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/avatar',      [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

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
