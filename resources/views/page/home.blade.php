<!DOCTYPE html>
<html>

<head>
    <title>Hakim Printing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style-home.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
                        <button type="submit" style="background:none; border:none; cursor:pointer;">Logout</button>
                    </form>
                </li>
            @elseif(Auth::check())
                {{--<li><a href="#">Halo, {{ Auth::user()->name }}</a></li>--}}
                <li><a href="/user">Pesanan</a></li>
                <li>
                    <form action="{{ route('logoutuserpage') }}" method="POST">
                        @csrf
                        <button type="submit" style="background:none; border:none; cursor:pointer;">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="/signup">Sign Up</a></li>
            @endif
        </ul>
    </nav>

    {{-- HERO --}}
    <section class="hero section-pink" id="hero">
        <div class="hero-text" data-aos="fade-right" data-aos-duration="1000">
            <h1><span id="typewriter"></span></h1>
            <p class="hero-desc">
                Ciptakan kesan pertama yang tak terlupakan untuk hari bahagia Anda. Kami menyediakan berbagai pilihan desain undangan pernikahan eksklusif dengan kualitas cetak premium yang disesuaikan dengan gaya Anda.
            </p>
            <a href="#product" class="hero-btn">Lihat Koleksi Kami</a>
        </div>
        <img src="{{ asset('images/img1.jpeg') }}" data-aos="fade-left" data-aos-duration="1200">
    </section>

    {{-- ABOUT --}}
    <section class="about section-white" id="about">
        <img src="{{ asset('images/img2.jpeg') }}" data-aos="zoom-in" data-aos-duration="1000">
        <div data-aos="fade-up" data-aos-duration="1200">
            <h2><span id="about-typewriter"></span></h2>
            <p data-aos="fade-up" data-aos-delay="500">
                Hakim Printing adalah percetakan spesialis undangan pernikahan yang didirikan dengan semangat untuk mengabadikan momen terindah Anda. Kami percaya bahwa undangan bukan sekadar kertas, melainkan cerminan dari kisah cinta dan kebahagiaan yang ingin Anda bagikan kepada orang-orang terkasih.
                <br><br>
                Dengan mengedepankan kualitas cetak tingkat tinggi, pilihan kertas premium, serta desain eksklusif, kami berkomitmen untuk mewujudkan undangan pernikahan impian yang elegan dan memukau.
            </p>
        </div>
    </section>

    {{-- PRODUCT --}}
    {{-- Kita bagi data produk per 5 item, lalu latar belakangnya dibuat selang-seling --}}
    @foreach ($products->chunk(5) as $index => $chunk)
        <section class="product {{ $index % 2 == 0 ? 'section-pink' : 'section-cream' }} {{ $index >= 2 ? 'hidden-product-section' : '' }}" {!! $index == 0 ? 'id="product"' : '' !!} {!! $index >= 2 ? 'style="display:none;"' : '' !!}>
            @if ($index == 0)
                <h2>Product</h2>
            @endif

            <div class="grid">
                @foreach ($chunk as $item)
                    <div class="item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="javascript:void(0)" onclick="openModal({{ $item->id }})">
                            <div class="card-img">
                                @php
                                    $productCode = $item->product_code;
                                    $cleanCodeUpper = str_replace('-', '', strtoupper($productCode)); // GS001
                                    $cleanCodeLower = strtolower($productCode); // gs-001
                                    
                                    $imagePath = 'images/' . $item->image; // fallback to DB
                                    
                                    $possibleFiles = [
                                        $cleanCodeUpper . '.jpeg', $cleanCodeUpper . '.jpg', $cleanCodeUpper . '.png',
                                        strtolower($cleanCodeUpper) . '.jpeg', strtolower($cleanCodeUpper) . '.jpg',
                                        $cleanCodeLower . '.jpeg', $cleanCodeLower . '.jpg', $cleanCodeLower . '.png',
                                        strtoupper($productCode) . '.jpeg', strtoupper($productCode) . '.jpg'
                                    ];
                                    
                                    foreach($possibleFiles as $file) {
                                        if(file_exists(public_path('images/' . $file))) {
                                            $imagePath = 'images/' . $file;
                                            break;
                                        }
                                    }
                                    
                                    if (Str::startsWith($item->image, 'products/')) {
                                        $imagePath = 'storage/' . $item->image;
                                    }
                                @endphp
                                <img src="{{ asset($imagePath) }}" alt="{{ $item->name }}">
                            </div>
                        </a>
                        <h3>{{ $item->name }}</h3>
                        <p>{{ $item->description }}</p>
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

    @if ($products->count() > 10)
        <div style="text-align:center; padding: 30px; background-color: #fcf9f2;" id="show-more-container">
            <button id="btn-show-more" onclick="showMoreProducts()" style="background-color:#EBD1A0; color:black; padding:12px 30px; border:none; border-radius:30px; cursor:pointer; font-size:16px; font-weight:600; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Tampilkan Lebih Banyak</button>
        </div>
        <script>
            function showMoreProducts() {
                const btn = document.getElementById('btn-show-more');
                btn.style.transform = 'scale(0.9)';
                btn.style.opacity = '0';
                
                setTimeout(() => {
                    document.getElementById('show-more-container').style.display = 'none';
                    
                    // Cari semua section produk yang masih disembunyikan
                    const hiddenSections = document.querySelectorAll('.hidden-product-section');
                    
                    // Tampilkan SEMUA section
                    for (let i = 0; i < hiddenSections.length; i++) {
                        hiddenSections[i].style.display = 'block';
                    }
                    
                    // Segarkan animasi AOS agar produk baru muncul dengan animasi yang mulus
                    if (typeof AOS !== 'undefined') {
                        AOS.refresh();
                    }
                }, 300);
            }
        </script>
    @endif

    {{-- MODAL AJAX --}}
    <style>
        .detail-card {
            max-width: 650px;
            margin: auto;
            padding: 25px;
            border-radius: 12px;
            background-color: #FDF8F0;
            color: #333;
        }
        .detail-header {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .detail-header h2 { margin: 0; font-size: 26px; }
        .detail-images {
            display: flex; gap: 10px; margin: 20px 0; justify-content: center;
        }
        .detail-images img { width: 45%; border-radius: 5px; }
        .detail-desc h3 { margin-bottom: 10px; }
        .detail-desc p { padding: 6px 0; font-size: 14px; border-bottom: 1px solid #ccc; }
        .detail-desc button {
            margin-top: 15px; padding: 10px 20px;
            background: #d6ae62; color: #3a2c17;
            border: none; border-radius: 12px; cursor: pointer; font-weight: bold;
        }
        .detail-desc button:hover { background: #bb9a5c; }
    </style>

    <div id="ajaxModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 9999; align-items: center; justify-content: center; overflow-y: auto; padding: 20px;">
        <div id="modalContent" style="background: #FDF8F0; padding: 30px; border-radius: 10px; max-width: 800px; width: 100%; position: relative; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            Loading...
        </div>
    </div>
    
    <script>
        function openModal(id) {
            const modal = document.getElementById('ajaxModal');
            const content = document.getElementById('modalContent');
            modal.style.display = 'flex';
            content.innerHTML = '<div style="text-align:center; padding: 50px;">Loading...</div>';
            
            fetch('/detail-product/' + id)
                .then(response => response.text())
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    let detailCard = doc.querySelector('.detail-card').innerHTML;
                    
                    // Replace the close link with a javascript close function
                    detailCard = detailCard.replace('<a href="/" class="close-btn">✕</a>', '<span class="close-btn" onclick="closeModal()" style="cursor:pointer; font-size: 24px; font-weight: bold; position: absolute; right: 20px; top: 20px;">✕</span>');
                    
                    content.innerHTML = detailCard;
                })
                .catch(err => {
                    content.innerHTML = '<div style="text-align:center; padding: 50px; color:red;">Gagal memuat data.</div><span class="close-btn" onclick="closeModal()" style="cursor:pointer; font-size: 24px; font-weight: bold; position: absolute; right: 20px; top: 20px;">✕</span>';
                });
        }
        
        function closeModal() {
            document.getElementById('ajaxModal').style.display = 'none';
        }
        
        // Tutup modal jika user mengklik area luar modal
        window.onclick = function(event) {
            const modal = document.getElementById('ajaxModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

    {{-- CONTACT --}}
    <section class="contact section-pink" id="contact">
        <div class="map" data-aos="fade-right" data-aos-duration="1000">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.473457428458!2d110.46122197457171!3d-7.73949849227904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5b0015672ad5%3A0xfc2cac214650f77e!2sHakim%20Printing!5e0!3m2!1sid!2sid!4v1774552938299!5m2!1sid!2sid"
                width="200" height="200" style="border:0;" loading="lazy">
            </iframe>
        </div>

        <div data-aos="fade-left" data-aos-duration="1200">
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

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, // whether animation should happen only once - while scrolling down
            offset: 100, // offset (in px) from the original trigger point
        });

        // Navbar shrink on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script>
        var typed = new Typed('#typewriter', {
            strings: ['Selamat Datang Di<br>Hakim Printing', 'Elegansi Dalam<br>Setiap Undangan', 'Wujudkan Undangan<br>Impian Anda'],
            typeSpeed: 60,
            backSpeed: 30,
            backDelay: 2000,
            loop: true,
            showCursor: true,
            cursorChar: '|',
        });

        // Setup Intersection Observer for the second typewriter so it starts when scrolled into view
        var aboutTypedStarted = false;
        var observer = new IntersectionObserver(function(entries) {
            if(entries[0].isIntersecting === true && !aboutTypedStarted) {
                aboutTypedStarted = true;
                new Typed('#about-typewriter', {
                    strings: ['Tentang Hakim Printing', 'Cerita Kami'],
                    typeSpeed: 60,
                    backSpeed: 30,
                    backDelay: 2000,
                    loop: true,
                    showCursor: true,
                    cursorChar: '|',
                });
            }
        }, { threshold: 0.5 });
        
        observer.observe(document.querySelector('#about'));
    </script>
</body>

</html>
