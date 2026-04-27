<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.home');
});

Route::get('/product/{id}', function ($id) {
    return view('page.detail-product');
});

Route::get('/signup', function () {
    return view('page.signup');
});

Route::get('/signup1', function () {
    return view('page.signin');
});

Route::get('/signin1', function () {
    return view('page.signin');
});

Route::get('/signin', function () {
    return view('page.user-page');
});

Route::get('/signup1', function () {
    return view('page.signup');
});


Route::get('/signout', function () {
    return view('page.home');
});

Route::get('/product/{id}', function ($id) {
    return view('page.detail-product', ['id' => $id]);
});

Route::get('/order/{id}', function ($id) {
    return view('page.order-data', ['id' => $id]);
});

Route::get('/information', function () {
    return view('page.info-invitation');
});

Route::get('/checkout', function () {
    return view('page.checkout');
});

Route::get('/konfirmasi', function () {
    return view('page.confirm');
});

Route::post('/logoutconfirm', function () {
    Auth::logout();
    return redirect('/');
})->name('logoutconfirm');

Route::get('/user-page', function () {
    return view('page.user-page');
})->name('user-page');

Route::get('/diproses', function () {
    return view('page.processed');
});

Route::get('/dikirim', function () {
    return view('page.shipping');
});

Route::get('/selesai', function () {
  return view('page.history');
});

Route::get('/', function () {
    return view('page.home');
});

Route::post('/logoutprocessed', function () {
    Auth::logout();
    return redirect('/');
})->name('logoutprocessed');

Route::post('/logouthistory', function () {
    Auth::logout();
    return redirect('/');
})->name('logouthistory');

Route::post('/logoutuserpage', function () {
    Auth::logout();
    return redirect('/');
})->name('logoutuserpage');

Route::post('/logoutshipping', function () {
    Auth::logout();
    return redirect('/');
})->name('logoutshipping');

Route::post('/logoutadminpage', function () {
    Auth::logout();
    return redirect('/');
})->name('logoutadminpage');

Route::get('/tambah-produk', function () {
    return view('admin.add-product');
});

Route::get('/diproses-admin', function () {
    return view('admin.order-processed');
});

Route::get('/dikirim-admin', function () {
    return view('admin.shipping-admin');
});

Route::get('history-admin', function () {
    return view('admin.admin-history');
});

Route::get('/user-page', function () {
    return view('page.user-page');
})->name('page.user-page');


// Uji Coba FE
Route::get('/login-admin', function () {
    session(['role' => 'admin']);
    return redirect('/admin');
});

Route::get('/login-user', function () {
    session(['role' => 'user']);
    return redirect('/');
});

Route::get('/logout', function () {
    session()->forget('role');
    return redirect('/');
});

Route::get('/admin', function () {

    if (session('role') != 'admin') {
        return redirect('/');
    }

    return view('admin.admin-page');
});
