<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/style-detailproduct.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <img src="{{ asset('images/logo.png') }}" class="logo">

    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/#about">About Us</a></li>
        <li><a href="/#product">Product</a></li>
        <li><a href="/#contact">Contact</a></li>
        <li>Sign Up</li>
    </ul>
</nav>

{{-- HERO --}}
<section class="hero" id="hero">
    <div class="hero-text">
        <h1>Selamat Datang Di <br> Hakim Printing</h1>
    </div>
    <img src="{{ asset('images/img1.jpeg') }}" alt="Hero Image">
</section>

{{-- ABOUT --}}
<section class="about" id="about">
    <img src="{{ asset('images/img2.jpeg') }}" alt="About Image">

    <div>
        <h2>Hakim Printing</h2>
        <p>Percetakan Undangan Pernikahan</p>
    </div>
</section>

{{-- PRODUCT DETAIL --}}
<section class="detail-wrapper" id="detail">

    <h2 class="section-title">Detail Product</h2>

    <div class="detail-card">

        {{-- HEADER --}}
        <div class="detail-header">
            <h2>{{ $product->name }}</h2>
            <a href="/" class="close-btn">✕</a>
        </div>

        {{-- IMAGE --}}
        <div class="detail-images">
            <img src="{{ Str::startsWith($product->image, 'products/') ? asset('storage/' . $product->image) : asset('images/' . $product->image) }}" alt="{{ $product->name }}">
        </div>

        {{-- DESKRIPSI --}}
        <div class="detail-desc">
            <h3>Deskripsi:</h3>

            <p>{{ $product->description }}</p>
            <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            @if(Auth::check() && Auth::user()->role == 'admin')
                <div style="display:flex; gap:10px;">
                    <a href="{{ route('admin.product.edit', $product->id) }}" style="text-decoration:none;">
                        <button style="background-color:#f0a500; color:#fff; border:none; border-radius:4px; padding:10px 20px; cursor:pointer;">Edit</button>
                    </a>
                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus produk ini?')" style="background-color:#e53e3e; color:#fff; border:none; border-radius:4px; padding:10px 20px; cursor:pointer;">Hapus</button>
                    </form>
                </div>
            @else
                <a href="{{ route('order.info', ['product_id' => $product->id]) }}">
                    <button>Pesan</button>
                </a>
            @endif
        </div>

    </div>

</section>

{{-- CONTACT --}}
<section class="contact" id="contact">

    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.473457428458!2d110.46122197457171!3d-7.73949849227904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5b0015672ad5%3A0xfc2cac214650f77e!2sHakim%20Printing!5e0!3m2!1sid!2sid!4v1774552938299!5m2!1sid!2sid"
            width="200"
            height="200"
            style="border:0;"
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
