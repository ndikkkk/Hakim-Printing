<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController; // Panggil AuthController

// ==========================================
// PUBLIC ROUTES (Tampilan Depan / User)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail-product', function () { return view('page.detail-product'); })->name('product.detail');

// ==========================================
// AUTH ROUTES (Sign In / Sign Up / Logout)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('signin');
    Route::post('/signin', [AuthController::class, 'login'])->name('signin.process');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

    Route::get('/signup', [AuthController::class, 'showRegistrationForm'])->name('signup');
    Route::post('/signup', [AuthController::class, 'register'])->name('signup.process');
});
// Rute logout saya samakan dengan tombol mas sebelumnya
Route::any('/logout-admin', [AuthController::class, 'logout'])->name('logoutadminpage');
Route::any('/logout-user', [AuthController::class, 'logout'])->name('logoutuserpage');
// ... (tambahkan route logout lainnya jika butuh, atau arahkan semuanya ke satu method logout)

// ==========================================
// PROTECTED ORDER FLOW ROUTES (Wajib Login)
// ==========================================
// Bungkus dengan middleware 'auth'. Kalau belum login, otomatis dilempar ke 'login' (kita samakan nama route login dengan signin nanti)
Route::middleware('auth')->prefix('order')->name('order.')->group(function () {
    Route::get('/info-invitation', [OrderController::class, 'showInfoForm'])->name('info');
    Route::post('/info-invitation', [OrderController::class, 'processInfoForm'])->name('info.process');

    Route::get('/data', [OrderController::class, 'showDataForm'])->name('data');
    Route::post('/data', [OrderController::class, 'processDataForm'])->name('data.process');

    Route::get('/shipping', function () { return view('page.shipping'); })->name('shipping');
    Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout');
    Route::get('/confirm', function () { return view('page.confirm'); })->name('confirm');
    Route::get('/processed', function () { return view('page.processed'); })->name('processed');

    Route::get('/get-cities/{province_id}', [OrderController::class, 'getCities'])->name('get.cities');
});

// ==========================================
// USER DASHBOARD & ADMIN ROUTES
// ==========================================
// (Biarkan rute admin dan user page seperti sebelumnya, nanti kita rapikan lebih lanjut)
Route::get('/user', function () { return view('page.user-page'); })->name('page.user-page');
Route::get('/history', function () { return view('page.history'); })->name('user.history');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () { return view('admin.admin-page'); })->name('dashboard');
    Route::get('/add-product', function () { return view('admin.add-product'); })->name('product.add');
    Route::get('/shipping', function () { return view('admin.shipping-admin'); })->name('shipping');
    Route::get('/history', function () { return view('admin.admin-history'); })->name('history');
    Route::get('/order-processed', function () { return view('admin.order-processed'); })->name('order.processed');
});
