<?php

use App\Http\Controllers\AiAssistantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
|
| Ketika aplikasi InoMitha dibuka, pengguna akan diarahkan
| terlebih dahulu menuju halaman login.
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Authentication - Guest
|--------------------------------------------------------------------------
|
| Route berikut hanya dapat diakses oleh pengguna
| yang belum melakukan login.
|
*/

Route::middleware('guest')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    // Menampilkan halaman login
    Route::get(
        '/login',
        [AuthController::class, 'showLogin']
    )->name('login');


    // Memproses login
    Route::post(
        '/login',
        [AuthController::class, 'login']
    )->name('login.process');

});


/*
|--------------------------------------------------------------------------
| Authentication - Protected Routes
|--------------------------------------------------------------------------
|
| Seluruh halaman utama InoMitha hanya dapat diakses
| setelah pengguna berhasil melakukan login.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    | Menampilkan ringkasan utama bisnis IntanMitha Collection,
    | termasuk penjualan, pelanggan, produk, stok,
    | produk terlaris, dan grafik penjualan.
    |
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Pelanggan
    |--------------------------------------------------------------------------
    |
    | Mengelola seluruh data pelanggan IntanMitha Collection.
    |
    */

    Route::resource(
        'customers',
        CustomerController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Kategori Produk
    |--------------------------------------------------------------------------
    |
    | Mengelola kategori yang digunakan untuk
    | mengelompokkan produk.
    |
    */

    Route::resource(
        'categories',
        CategoryController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Produk
    |--------------------------------------------------------------------------
    |
    | Mengelola data produk, kategori, harga,
    | stok minimum, dan status produk.
    |
    */

    Route::resource(
        'products',
        ProductController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Persediaan
    |--------------------------------------------------------------------------
    |
    | Mengelola kondisi stok, stok masuk,
    | stok keluar manual, dan riwayat pergerakan stok.
    |
    */

    // Halaman utama persediaan
    Route::get(
        '/inventory',
        [InventoryController::class, 'index']
    )->name('inventory.index');


    // Form stok masuk
    Route::get(
        '/inventory/stock-in',
        [InventoryController::class, 'createStockIn']
    )->name('inventory.stock-in.create');


    // Menyimpan stok masuk
    Route::post(
        '/inventory/stock-in',
        [InventoryController::class, 'storeStockIn']
    )->name('inventory.stock-in.store');


    // Form stok keluar manual
    Route::get(
        '/inventory/stock-out',
        [InventoryController::class, 'createStockOut']
    )->name('inventory.stock-out.create');


    // Menyimpan stok keluar manual
    Route::post(
        '/inventory/stock-out',
        [InventoryController::class, 'storeStockOut']
    )->name('inventory.stock-out.store');


    // Riwayat pergerakan stok
    Route::get(
        '/inventory/history',
        [InventoryController::class, 'history']
    )->name('inventory.history');


    /*
    |--------------------------------------------------------------------------
    | Transaksi Penjualan
    |--------------------------------------------------------------------------
    |
    | Modul transaksi menggunakan index, create,
    | store, dan show.
    |
    | Edit dan delete tidak digunakan karena transaksi
    | sudah berhubungan langsung dengan perubahan stok.
    |
    */

    Route::resource(
        'sales',
        SaleController::class
    )->only([
        'index',
        'create',
        'store',
        'show',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Pembatalan Transaksi
    |--------------------------------------------------------------------------
    |
    | Transaksi yang dibatalkan tidak dihapus.
    | Status diubah menjadi cancelled dan stok produk
    | dikembalikan ke persediaan.
    |
    */

    Route::patch(
        '/sales/{sale}/cancel',
        [SaleController::class, 'cancel']
    )->name('sales.cancel');


    /*
    |--------------------------------------------------------------------------
    | Laporan
    |--------------------------------------------------------------------------
    |
    | Menampilkan laporan penjualan, produk terlaris,
    | pelanggan teratas, dan kondisi persediaan.
    |
    */

    Route::get(
        '/reports',
        [ReportController::class, 'index']
    )->name('reports.index');


    /*
    |--------------------------------------------------------------------------
    | AI Business Assistant
    |--------------------------------------------------------------------------
    |
    | Menampilkan halaman AI Business Assistant InoMitha
    | yang digunakan untuk analisis penjualan,
    | rekomendasi promosi, dan rekomendasi persediaan.
    |
    */

    Route::get(
        '/ai-assistant',
        [AiAssistantController::class, 'index']
    )->name('ai.index');

    Route::post(
    '/ai-assistant/analyze',
    [AiAssistantController::class, 'analyze']
    )->name('ai.analyze');

    Route::get(
        '/ai-assistant/history/{aiRecommendation}',
        [AiAssistantController::class, 'show']
    )->name('ai.show');

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/logout',
        [AuthController::class, 'logout']
    )->name('logout');

});