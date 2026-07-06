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

<nav class="navbar" style="position: relative; display: flex; justify-content: space-between; align-items: center; padding: 10px 5%;">
    <a href="{{ route('home') }}" style="display: block; transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        <img src="{{ asset('images/logo.png') }}" class="logo" style="height: 55px; width: auto; margin: 0;">
    </a>
    
    <h2 style="display:none;">Halaman Admin</h2>

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


<div class="user-section" style="padding: 0 5%; margin-bottom: 60px;">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 25px; max-width: 1100px; margin: 0 auto;">

        <a href="/admin/add-product" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); padding: 30px 15px; border-radius: 20px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;" class="menu-card" data-aos="fade-up" data-aos-delay="100">
            <div style="width: 65px; height: 65px; background: #e6f2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 15px rgba(0,123,255,0.15);">
                <img src="{{ asset('images/add-catalog.png') }}" style="width: 32px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
            </div>
            <p style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.05rem; margin: 0;">Tambah Produk</p>
            <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #007bff; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;" class="card-line"></div>
        </a>

        <a href="{{ route('admin.product.list') }}" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); padding: 30px 15px; border-radius: 20px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;" class="menu-card" data-aos="fade-up" data-aos-delay="200">
            <div style="width: 65px; height: 65px; background: #f3e6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 15px rgba(111,66,193,0.15);">
                <img src="{{ asset('images/finished.png') }}" style="width: 32px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
            </div>
            <p style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.05rem; margin: 0;">Daftar Produk</p>
            <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #6f42c1; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;" class="card-line"></div>
        </a>

        <a href="/admin/order-processed" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); padding: 30px 15px; border-radius: 20px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;" class="menu-card" data-aos="fade-up" data-aos-delay="300">
            <div style="width: 65px; height: 65px; background: #fff5e6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 15px rgba(255,165,0,0.15);">
                <img src="{{ asset('images/processed.png') }}" style="width: 32px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
            </div>
            <p style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.05rem; margin: 0;">Diproses</p>
            <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #ffa500; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;" class="card-line"></div>
        </a>

        <a href="/admin/shipping" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); padding: 30px 15px; border-radius: 20px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;" class="menu-card" data-aos="fade-up" data-aos-delay="400">
            <div style="width: 65px; height: 65px; background: #e6f9ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 15px rgba(23,162,184,0.15);">
                <img src="{{ asset('images/shipping.png') }}" style="width: 32px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
            </div>
            <p style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.05rem; margin: 0;">Dikirim</p>
            <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #17a2b8; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;" class="card-line"></div>
        </a>

        <a href="/admin/history" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); padding: 30px 15px; border-radius: 20px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;" class="menu-card" data-aos="fade-up" data-aos-delay="500">
            <div style="width: 65px; height: 65px; background: #e6ffe6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 15px rgba(40,167,69,0.15);">
                <img src="{{ asset('images/finished.png') }}" style="width: 32px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
            </div>
            <p style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.05rem; margin: 0;">Daftar Pesanan</p>
            <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #28a745; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;" class="card-line"></div>
        </a>
    </div>
</div>

<style>
    .menu-card:hover {
        transform: translateY(-8px);
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
