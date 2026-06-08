<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Admin</title>

    <link rel="stylesheet" href="{{ asset('css/style-userpage.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body>

<nav class="navbar" style="position: relative;">
    <a href="{{ route('home') }}" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); text-decoration: none; color: #555; background: #fff; padding: 8px 15px; border-radius: 20px; font-weight: 500; font-size: 14px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 5px;">
        &larr; Kembali ke Beranda
    </a>
    <img src="{{ asset('images/logo.png') }}" class="logo">

    <h2>Halaman Admin</h2>

    <form action="{{ route('logoutadminpage') }}" method="POST">
        @csrf
        <button type="submit" class="logout-link">
            <img src="{{ asset('images/logout.png') }}" class="logout-icon">
            Sign Out
        </button>
    </form>
</nav>

<div class="greeting">
    <h3>Halo, {{ auth()->user()->name ?? 'Admin' }}</h3>
</div>


<div class="user-section">
    <div class="menu">

        <a href="/admin/add-product" class="menu-item">
            <img src="{{ asset('images/add-catalog.png') }}">
            <p>Tambah Produk</p>
        </a>

        <a href="{{ route('admin.product.list') }}" class="menu-item">
            <img src="{{ asset('images/finished.png') }}">
            <p>Daftar Produk</p>
        </a>

        <a href="/admin/order-processed" class="menu-item">
            <img src="{{ asset('images/processed.png') }}">
            <p>Diproses</p>
        </a>

        <a href="/admin/shipping" class="menu-item">
            <img src="{{ asset('images/shipping.png') }}">
            <p>Dikirim</p>
        </a>

        <a href="/admin/history" class="menu-item">
            <img src="{{ asset('images/finished.png') }}">
            <p>Daftar Pesanan</p>
        </a>
    </div>
</div>


<section class="contact">
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.473457428458!2d110.46122197457171!3d-7.73949849227904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5b0015672ad5%3A0xfc2cac214650f77e!2sHakim%20Printing!5e0!3m2!1sid!2sid!4v1774552938299!5m2!1sid!2sid"
            width="200"
            height="200"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>

    <div>
        <h2>Alamat & Kontak</h2>

        <p class="contact-item">
            <img src="{{ asset('images/location.png') }}" class="icon">
            <span>
                Kalimati, Tirtomartani, Kec. Kalasan,
                Kabupaten Sleman, Daerah Istimewa Yogyakarta 55571
            </span>
        </p>

        <p class="contact-item">
            <img src="{{ asset('images/whatsapp.png') }}" class="icon">
            <span>+62 896-1294-622</span>
        </p>

        <p class="contact-item">
            <img src="{{ asset('images/email.png') }}" class="icon">
            <span>email@gmail.com</span>
        </p>
    </div>
</section>

</body>
</html>
