<?php

use App\Http\Controllers\Admin\CategoriesControllers;
use App\Http\Controllers\Admin\DashboardControllers;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\User\TransaksiController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Users
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/proses_login', [AuthController::class, 'login'])->name('proses.login');
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/proses_register', [AuthController::class, 'register'])->name('proses.register');

Route::get('/', [UserProductController::class, 'index'])->name('welcome');
Route::get('/product', [UserProductController::class, 'show'])->name('product.show');
Route::post('/product/search', [SearchController::class, 'product_search'])->name('product.search');
Route::get('/product/search/{nama}', [SearchController::class, 'search'])->name('search.product');
Route::get('/product/detail/{id}', [UserProductController::class, 'detail_product'])->name('product.detail');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/invoice/{kode_order}', [InvoiceController::class, 'show'])->name('invoice.show');

    // Cart
    Route::post('/product/cart/proses', [CartController::class, 'create'])->name('product.add.cart');
    Route::post('/product/cart/proses/detail', [CartController::class, 'add'])->name('product.add.detail.cart');
    Route::get('/product/cart/delete/all', [CartController::class, 'deleteAll'])->name('product.cart.delete.all');
    Route::post('/product/cart/delete/{id}', [CartController::class, 'destroy'])->name('product.cart.delete');
    Route::get('/product/cart', [CartController::class, 'index'])->name('product.cart');
    Route::get('/product/cart/checkout', [CheckoutController::class, 'index'])->name('product.cart.checkout');
    Route::post('/product/cart/checkout/proses', [CheckoutController::class, 'store'])->name('user.checkout');

    // transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
    Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail_transaksi'])->name('user.detail.transaksi');
    Route::post('/transaksi/detail/upload_pembayaran/proses', [TransaksiController::class, 'upload_bukti'])->name('user.upload.bukti');
    Route::get('/transaksi/detail/konfirmasi/proses/{id}', [TransaksiController::class, 'konfirmasi_barang'])->name('user.konfirmasi.barang');
});


// Route::get('/product', [ProductController::class, 'index'])->name('product');

// Admin
Route::get('/admin', function () {
    return view('admin.login');
})->name('admin.login');
Route::post('/proses/login', [AuthController::class, 'ProsesAdminlogin'])->name('proses.admin.login');

Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
    Route::get('/logout/proses', [AuthController::class, 'logout_admin'])->name('admin.logout');
    Route::get('/dashboard', [DashboardControllers::class, 'index'])->name('admin.dashboard');
    Route::get('/earnings/report', [DashboardControllers::class, 'earnings'])->name('admin.earnings.report');
    Route::post('/earnings/report/search', [DashboardControllers::class, 'earnings_search'])->name('admin.earnings.report.search');
    Route::get('/product/banyak terbeli', [DashboardControllers::class, 'most_buying'])->name('admin.product.most.buying');
    Route::post('/product/search/banyakTerbeli', [DashboardControllers::class, 'most_buying_search'])->name('admin.product.most.search');

    // product
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::post('/product/create', [ProductController::class, 'store'])->name('admin.product.create');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::post('/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');

    // category
    Route::get('/category', [CategoriesControllers::class, 'index'])->name('admin.category');
    Route::post('/category/create', [CategoriesControllers::class, 'store'])->name('admin.create.categories');
    Route::post('/category/update/{id}', [CategoriesControllers::class, 'update'])->name('admin.categories.update');
    Route::post('/category/delete/{id}', [CategoriesControllers::class, 'destroy'])->name('admin.categories.delete');

    // Order
    Route::get('/Order', [OrderController::class, 'index'])->name('admin.order');
    Route::get('/Order/detail/{id}', [OrderController::class, 'detail'])->name('admin.detail.order');
    Route::get('/Order/detail/konfirmasi/{id}', [OrderController::class, 'konfirmasi'])->name('admin.order.konfirmasi');
    Route::get('/Order/detail/konfirmasi/gagal/{id}', [OrderController::class, 'gagalkan'])->name('admin.order.konfirmasi.gagal');


    // User
    Route::get('/user', [DashboardControllers::class, 'user_page'])->name('admin.user');

    // setting
    Route::get('/setting/toko', [DashboardControllers::class, 'toko'])->name('admin.toko');
    Route::post('/setting/toko/create', [DashboardControllers::class, 'add_setting'])->name('admin.toko.store');
    Route::post('/setting/toko/update/{id}', [DashboardControllers::class, 'update_toko'])->name('admin.toko.update');
    Route::get('/setting/ongkir', [DashboardControllers::class, 'setting_ongkir'])->name('admin.ongkir');
    Route::post('/setting/ongkir/create', [DashboardControllers::class, 'add_ongkir'])->name('admin.add.ongkir');
    Route::post('/setting/ongkir/delete/{id}', [DashboardControllers::class, 'delete_ongkir'])->name('admin.delete.ongkir');
});
