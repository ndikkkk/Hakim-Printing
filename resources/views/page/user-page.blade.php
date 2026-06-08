<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style-userpage.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Halaman Pengguna</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar" style="position: relative;">
    <a href="{{ route('home') }}" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); text-decoration: none; color: #555; background: #fff; padding: 8px 15px; border-radius: 5px; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">← Kembali Beranda</a>
    <img src="{{ asset('images/logo.png') }}" class="logo" style="margin-left: auto; margin-right: auto;">
    <h2 style="display:none;">Halaman Pengguna</h2>

    {{-- Tombol Sign Out HANYA muncul jika sudah login --}}
    @auth
    <form action="{{ route('logoutuserpage') }}" method="POST">
        @csrf
        <button type="submit" class="logout-link">
            <img src="{{ asset('images/logout.png') }}" class="logout-icon">
            Sign Out
        </button>
    </form>
    @endauth
</nav>

<div class="greeting" style="padding: 20px 5%;" data-aos="fade-down" data-aos-duration="1000">
    <h3 style="color: #333;">Halo, {{ auth()->user()->name }}</h3>
</div>

{{-- KONTEN UTAMA (Hanya Muncul Jika Login) --}}
@auth
    {{-- MENU --}}
    <div class="user-section">
        <div class="menu">
            <a href="{{ route('user.processed') }}" class="menu-item" data-aos="zoom-in" data-aos-delay="100">
                <img src="{{ asset('images/processed.png') }}">
                <p>Diproses</p>
            </a>
            <a href="{{ route('user.shipping') }}" class="menu-shipping" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('images/shipping.png') }}">
                <p>Dikirim</p>
            </a>
            <a href="{{ route('user.history') }}" class="menu-finished" data-aos="zoom-in" data-aos-delay="300">
                <img src="{{ asset('images/finished.png') }}">
                <p>Selesai</p>
            </a>
            <a href="/" class="menu-catalog" data-aos="zoom-in" data-aos-delay="400">
                <img src="{{ asset('images/catalog.png') }}">
                <p>Katalog</p>
            </a>
        </div>
    </div>
@else
    {{-- TAMPILAN JIKA GUEST (Belum Login) --}}
    <div style="padding: 80px 5%; text-align: center;">
        <h3 style="margin-bottom: 10px; color: #333;">Anda Belum Login</h3>
        <p style="margin-bottom: 25px; color: #666;">Silakan login terlebih dahulu untuk melihat riwayat pesanan dan menu pengguna.</p>
        <a href="{{ route('login') }}" style="padding: 10px 25px; background-color: #b0435e; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Masuk ke Akun</a>
    </div>
@endauth

{{-- CONTACT --}}
<section class="contact" data-aos="fade-up" data-aos-duration="1000">
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
            <span>Kalimati, Tirtomartani, Kec. Kalasan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55571</span>
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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        offset: 50,
    });
</script>
</body>
</html>
