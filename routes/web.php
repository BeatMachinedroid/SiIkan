<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductController;



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

Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/proses_login', [AuthController::class, 'login'])->name('proses.login');
Route::get('/register', function () { return view('register'); })->name('register');
Route::post('/proses_register', [AuthController::class, 'register'])->name('proses.register');

Route::get('/product', [ProductController::class, 'index'])->name('product');

// Admin
Route::get('/admin', function () { return view('admin.login'); })->name('admin.login');
Route::post('/proses/login', [AuthController::class, 'ProsesAdminlogin'])->name('proses.admin.login');

Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
        Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/dashboard', function () {  return view('admin.dashboard'); })->name('admin.dashboard');
});

