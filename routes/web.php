<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// ==========================================
// PUBLIC ROUTES (Tampilan Depan / User)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail-product', function () { return view('page.detail-product'); })->name('product.detail');

// ==========================================
// ORDER FLOW ROUTES (Alur Pemesanan)
// ==========================================
Route::prefix('order')->name('order.')->group(function () {
    Route::get('/info-invitation', function () { return view('page.info-invitation'); })->name('info');
    Route::get('/data', function () { return view('page.order-data'); })->name('data');
    Route::get('/shipping', function () { return view('page.shipping'); })->name('shipping');
    Route::get('/checkout', function () { return view('page.checkout'); })->name('checkout');
    Route::get('/confirm', function () { return view('page.confirm'); })->name('confirm');
    Route::get('/processed', function () { return view('page.processed'); })->name('processed');
});

// ==========================================
// USER DASHBOARD & AUTH ROUTES
// ==========================================
Route::get('/signin', function () { return view('page.signin'); })->name('signin');
Route::get('/signup', function () { return view('page.signup'); })->name('signup');
Route::get('/user', function () { return view('page.user-page'); })->name('user.page');
Route::get('/history', function () { return view('page.history'); })->name('user.history');

// ==========================================
// ADMIN ROUTES (Panel Admin)
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () { return view('admin.admin-page'); })->name('dashboard');
    Route::get('/add-product', function () { return view('admin.add-product'); })->name('product.add');
    Route::get('/shipping', function () { return view('admin.shipping-admin'); })->name('shipping');
    Route::get('/history', function () { return view('admin.admin-history'); })->name('history');
    Route::get('/order-processed', function () { return view('admin.order-processed'); })->name('order.processed');
});

// ==========================================
// ACTION ROUTES (Fungsi Logout Sementara)
// ==========================================
// Saya gunakan Route::any agar tidak error saat diklik via link <a> (GET) atau form (POST)
// Logic Auth::logout() dihilangkan dulu sementara agar web tidak crash

Route::any('/logout-admin', function () { return redirect('/'); })->name('logoutadminpage');
Route::any('/logout-user', function () { return redirect('/'); })->name('logoutuserpage');
Route::any('/logout-processed', function () { return redirect('/'); })->name('logoutprocessed');
Route::any('/logout-history', function () { return redirect('/'); })->name('logouthistory');
Route::any('/logout-shipping', function () { return redirect('/'); })->name('logoutshipping');
Route::any('/logout-confirm', function () { return redirect('/'); })->name('logoutconfirm');
