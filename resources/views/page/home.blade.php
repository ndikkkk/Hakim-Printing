<!DOCTYPE html>
<html>

<head>
    <title>Hakim Printing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style-home.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <img src="{{ asset('images/logo.png') }}" class="logo">

        <ul>
            <li><a href="#hero">Beranda</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="{{ url('/') }}#product">Produk</a></li>
            <li><a href="#contact">Kontak</a></li>

            {{-- ini buat ujicoba login & routing bagian front end, nanti tinggal diganti dikit aja kalo dh masukin role di db --}}

            @if (Auth::check() && Auth::user()->role == 'admin')
                <li><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                <li>
                    <form action="{{ route('logoutadminpage') }}" method="POST">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">Logout</button>
                    </form>
                </li>
            @elseif(Auth::check())
                {{--<li><a href="#">Halo, {{ Auth::user()->name }}</a></li>--}}
                <li><a href="/user">Dashboard</a></li>
                <li>
                    <form action="{{ route('logoutuserpage') }}" method="POST">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; font:inherit;">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="/signup">Sign Up</a></li>
            @endif
        </ul>
    </nav>

    {{-- HERO --}}
    <section class="hero section-pink" id="hero">
        <div class="hero-text">
            <h1>Selamat Datang Di <br> Hakim Printing</h1>
        </div>
        <img src="{{ asset('images/img1.jpeg') }}">
    </section>

    {{-- ABOUT --}}
    <section class="about section-white" id="about">
        <img src="{{ asset('images/img2.jpeg') }}">
        <div>
            <h2>Hakim Printing</h2>
            <p>Percetakan Undangan Pernikahan</p>
        </div>
    </section>

    {{-- PRODUCT --}}
    {{-- Kita bagi data produk per 5 item, lalu latar belakangnya dibuat selang-seling --}}
    @foreach ($products->chunk(5) as $index => $chunk)
        <section class="product {{ $index % 2 == 0 ? 'section-pink' : 'section-cream' }}" {!! $index == 0 ? 'id="product"' : '' !!}>
            @if ($index == 0)
                <h2>Product</h2>
            @endif

            <div class="grid">
                @foreach ($chunk as $item)
                    <div class="item">
                        {{-- Link ke halaman detail membawa ID produk --}}
                        <a href="{{ route('product.detail', ['id' => $item->id]) }}#detail">
                            <div class="card-img">
                                <img src="{{ Str::startsWith($item->image, 'products/') ? asset('storage/' . $item->image) : asset('images/' . $item->image) }}" alt="{{ $item->name }}">
                            </div>
                        </a>
                        <h3>{{ $item->name }}</h3>
                        <p>{{ Str::limit($item->description, 40) }}</p>
                        <p class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        @if(Auth::check() && Auth::user()->role == 'admin')
                            <div style="display:flex; gap:10px; margin-top:auto;">
                                <a href="{{ route('admin.product.edit', $item->id) }}" style="text-decoration:none;">
                                    <button style="background-color:#f0a500; color:#fff; border:none; border-radius:4px; padding:8px 15px; cursor:pointer;">Edit</button>
                                </a>
                                <form action="{{ route('admin.product.destroy', $item->id) }}" method="POST" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus produk ini?')" style="background-color:#e53e3e; color:#fff; border:none; border-radius:4px; padding:8px 15px; cursor:pointer;">Hapus</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('order.info', ['product_id' => $item->id]) }}" style="margin-top:auto;">
                                <button>Pesan</button>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

    {{-- CONTACT --}}
    <section class="contact section-pink" id="contact">
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.473457428458!2d110.46122197457171!3d-7.73949849227904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5b0015672ad5%3A0xfc2cac214650f77e!2sHakim%20Printing!5e0!3m2!1sid!2sid!4v1774552938299!5m2!1sid!2sid"
                width="200" height="200" style="border:0;" loading="lazy">
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
