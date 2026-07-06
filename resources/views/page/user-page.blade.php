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
<nav class="navbar" style="position: relative; display: flex; justify-content: space-between; align-items: center; padding: 10px 5%;">
    <a href="{{ route('home') }}" style="display: block; transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        <img src="{{ asset('images/logo.png') }}" class="logo" style="height: 55px; width: auto; margin: 0;">
    </a>
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
    <div class="user-section" style="padding: 0 5%; margin-bottom: 60px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 30px; max-width: 1000px; margin: 0 auto;">
            
            <a href="{{ route('user.processed') }}" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); padding: 40px 20px; border-radius: 20px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;" class="menu-card" data-aos="fade-up" data-aos-delay="100">
                <div style="width: 70px; height: 70px; background: #fff5e6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 15px rgba(255,165,0,0.15);">
                    <img src="{{ asset('images/processed.png') }}" style="width: 35px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
                </div>
                <p style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem; margin: 0;">Diproses</p>
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #ffa500; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;" class="card-line"></div>
            </a>

            <a href="{{ route('user.shipping') }}" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); padding: 40px 20px; border-radius: 20px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;" class="menu-card" data-aos="fade-up" data-aos-delay="200">
                <div style="width: 70px; height: 70px; background: #e6f2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 15px rgba(0,123,255,0.15);">
                    <img src="{{ asset('images/shipping.png') }}" style="width: 35px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
                </div>
                <p style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem; margin: 0;">Dikirim</p>
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #007bff; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;" class="card-line"></div>
            </a>

            <a href="{{ route('user.history') }}" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); padding: 40px 20px; border-radius: 20px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;" class="menu-card" data-aos="fade-up" data-aos-delay="300">
                <div style="width: 70px; height: 70px; background: #e6ffe6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 15px rgba(40,167,69,0.15);">
                    <img src="{{ asset('images/finished.png') }}" style="width: 35px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
                </div>
                <p style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem; margin: 0;">Selesai</p>
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #28a745; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;" class="card-line"></div>
            </a>

            <a href="/" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); padding: 40px 20px; border-radius: 20px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;" class="menu-card" data-aos="fade-up" data-aos-delay="400">
                <div style="width: 70px; height: 70px; background: #fdf5e6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 15px rgba(182,137,91,0.2);">
                    <img src="{{ asset('images/catalog.png') }}" style="width: 35px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
                </div>
                <p style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem; margin: 0;">Katalog</p>
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #b6895b; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;" class="card-line"></div>
            </a>

        </div>
    </div>

    <style>
        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        }
        .menu-card:hover .card-line {
            transform: scaleX(1) !important;
        }
        .menu-card img {
            transition: transform 0.3s ease;
        }
        .menu-card:hover img {
            transform: scale(1.15);
        }
    </style>
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
