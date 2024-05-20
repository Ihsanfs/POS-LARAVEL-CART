<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified', 'role:1'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function() {
        Route::get('/dashboard', function () {
            return view('page.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
        })->name('dashboard');

        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.list');
        Route::get('/produk/check', [ProdukController::class, 'produkcheck'])->name('produk.check');
        Route::get('/produk/cart/view', [ProdukController::class, 'keranjang'])->name('cart');
        Route::get('/produk/cart/checkout', [ProdukController::class, 'checkout'])->name('checkout');
        Route::get('/produk/data', [ProdukController::class, 'produkdata'])->name('produk.data');
        Route::get('/produk/cart/{id}', [ProdukController::class, 'produkcart'])->name('add.to.cart');
        Route::patch('update-cart', [ProdukController::class, 'update'])->name('update.cart');
        Route::delete('remove-from-cart', [ProdukController::class, 'remove'])->name('remove.from.cart');
        Route::post('/produk/store', [ProdukController::class, 'store'])->name('simpan');
        Route::get('/produk/create', [ProdukController::class, 'produk_create'])->name('produk.create');

        Route::post('/produk/store/produk', [ProdukController::class, 'store_produk'])->name('simpan.produk');

        Route::post('/produk/pesan', [ProdukController::class, 'pesan'])->name('pesan');



    });

    Route::middleware(['auth', 'verified', 'role:2'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function() {
        Route::get('/dashboard', function () {
            return view('page.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
        })->name('dashboard');
    });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
