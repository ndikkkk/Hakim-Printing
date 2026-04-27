<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/style-userpage.css') }}">
    <title>Halaman Pengguna</title>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <img src="{{ asset('images/logo.png') }}" class="logo">

    <h2>Halaman Pengguna</h2>
<form action="{{ route('logoutconfirm') }}" method="POST">
    @csrf
    <button type="submit" class="logout-link">
        <img src="{{ asset('images/logout.png') }}" class="logout-icon">
        Sign Out
    </button>
</form>
</nav>

{{-- GREETING --}}
<div class="greeting">
    <h3>Halo, {{ auth()->user()->name ?? 'User' }}</h3>
</div>

{{-- MENU --}}
<div class="user-section">
    <div class="menu">

        <a href="/diproses" class="menu-item">
            <img src="{{ asset('images/processed.png') }}">
            <p>Diproses</p>
        </a>

        <a href="/dikirim" class="menu-shipping">
            <img src="{{ asset('images/shipping.png') }}">
            <p>Dikirim</p>
        </a>

        <a href="/selesai" class="menu-finished">
            <img src="{{ asset('images/finished.png') }}">
            <p>Selesai</p>
        </a>

        <a href="/" class="menu-catalog">
            <img src="{{ asset('images/catalog.png') }}">
            <p>Katalog</p>
        </a>

    </div>
</div>

{{-- CONTACT --}}
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
        Kalimati, Tirtomartani, Kec. Kalasan, Kabupaten Sleman,
        Daerah Istimewa Yogyakarta 55571
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

