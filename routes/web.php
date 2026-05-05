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

    // INI BARIS BARU UNTUK MEMPROSES TOMBOL CHECKOUT
    Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout.process');

    Route::get('/confirm', function () { return view('page.confirm'); })->name('confirm');
    Route::get('/processed', function () { return view('page.processed'); })->name('processed');

    Route::get('/get-cities/{province_id}', [OrderController::class, 'getCities'])->name('get.cities');
});

Route::post('/midtrans/callback', [OrderController::class, 'callback']);

// ==========================================
// USER DASHBOARD & ADMIN ROUTES
// ==========================================

// Halaman utama user (wajib login)
Route::get('/user', function () {
    return view('page.user-page');
})->middleware('auth')->name('page.user');

// Diproses: lunas, belum ada resi
Route::get('/diproses', function () {
    $orders = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->where('payment_status', 'success', 'pending')
                ->whereNull('resi')
                ->orderBy('created_at', 'desc')
                ->get();
    return view('page.processed', compact('orders'));
})->middleware('auth')->name('user.processed');

// Dikirim: sudah ada resi, belum dikonfirmasi terima
Route::get('/dikirim', function () {
    $orders = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->where('payment_status', 'success')
                ->whereNotNull('resi')
                ->where('is_received', false)
                ->orderBy('created_at', 'desc')
                ->get();
    return view('page.shipping', compact('orders'));
})->middleware('auth')->name('user.shipping');

// Selesai: sudah dikonfirmasi diterima oleh user
Route::get('/selesai', function () {
    $orders = \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->where('is_received', true)
                ->orderBy('created_at', 'desc')
                ->get();
    return view('page.history', compact('orders'));
})->middleware('auth')->name('user.history');

// Route konfirmasi terima
Route::post('/order/{id}/terima', [\App\Http\Controllers\OrderController::class, 'confirmReceived'])
    ->middleware('auth')
    ->name('user.confirm-received');

// --- ADMIN ROUTES (tambah middleware auth) ---
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () { return view('admin.admin-page'); })->name('dashboard');
    Route::get('/add-product', function () { return view('admin.add-product'); })->name('product.add');

    Route::get('/order-processed', function () {
        $orders = \App\Models\Order::whereNull('resi')
                    ->where(function($query) {
                        $query->where('payment_status', 'success')
                              ->orWhere('payment_status', 'pending');
                    })
                    ->orderBy('created_at', 'desc')->get();
        return view('admin.order-processed', compact('orders'));
    })->name('order.processed');

    Route::post('/order/{id}/resi', [OrderController::class, 'inputResi'])->name('order.resi');

    Route::get('/shipping', function () {
        $orders = \App\Models\Order::where('payment_status', 'success')
                    ->whereNotNull('resi')
                    ->orderBy('created_at', 'desc')->get();
        return view('admin.shipping-admin', compact('orders'));
    })->name('shipping');

    Route::get('/history', function () {
        $orders = \App\Models\Order::orderBy('created_at', 'desc')->get();
        return view('admin.admin-history', compact('orders'));
    })->name('history');
});
