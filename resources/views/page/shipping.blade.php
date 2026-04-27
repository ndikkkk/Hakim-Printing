<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Dikirim</title>

    <link rel="stylesheet" href="{{ asset('css/style-shipping.css') }}">
</head>
<body>

{{-- HEADER --}}
<div class="header">
    <img src="{{ asset('images/logo.png') }}" class="logo">

    <h2>Pesanan yang Dikirim</h2>

    <a href="{{ route('page.user-page') }}" class="back">Back</a>
</div>

{{-- LIST PESANAN --}}
<div class="container">

    {{-- ===== PRODUK 1 ===== --}}
    <div class="order-card">
        <div class="left">
            <h4>Product A</h4>
            <p>x 200</p>
            <p class="price">Rp. xxxxx,xx</p>

            <div class="shipping-status">
                <div class="status-header">
                    <img src="{{ asset('images/shipping.png') }}" class="icon-img">
                    <p>Status Pengiriman</p>
                </div>

                <div class="timeline">
                    <div class="step active">
                        <span class="dot"></span>
                        <p>Paket sedang di jalan</p>
                    </div>
                    <div class="step">
                        <span class="dot"></span>
                        <p>Paket sampai di kota tujuan</p>
                    </div>
                    <div class="step">
                        <span class="dot"></span>
                        <p>Paket sampai ke penerima</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="right">
            <p>No Resi:</p>
            <span>xxxxxxxxxxxxxxxxxxxx</span>
        </div>
    </div>

    {{-- ===== PRODUK 2 ===== --}}
    <div class="order-card">
        <div class="left">
            <h4>Product B</h4>
            <p>x 150</p>
            <p class="price">Rp. xxxxx,xx</p>

            <div class="shipping-status">
                <div class="status-header">
                    <img src="{{ asset('images/shipping.png') }}" class="icon-img">
                    <p>Status Pengiriman</p>
                </div>

                <div class="timeline">
                    <div class="step active">
                        <span class="dot"></span>
                        <p>Paket sedang di jalan</p>
                    </div>
                    <div class="step">
                        <span class="dot"></span>
                        <p>Paket sampai di kota tujuan</p>
                    </div>
                    <div class="step">
                        <span class="dot"></span>
                        <p>Paket sampai ke penerima</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="right">
            <p>No Resi:</p>
            <span>xxxxxxxxxxxxxxxxxxxx</span>
        </div>
    </div>

    {{-- ===== PRODUK 3 ===== --}}
    <div class="order-card">
        <div class="left">
            <h4>Product C</h4>
            <p>x 100</p>
            <p class="price">Rp. xxxxx,xx</p>

            <div class="shipping-status">
                <div class="status-header">
                    <img src="{{ asset('images/shipping.png') }}" class="icon-img">
                    <p>Status Pengiriman</p>
                </div>

                <div class="timeline">
                    <div class="step active">
                        <span class="dot"></span>
                        <p>Paket sedang di jalan</p>
                    </div>
                    <div class="step">
                        <span class="dot"></span>
                        <p>Paket sampai di kota tujuan</p>
                    </div>
                    <div class="step">
                        <span class="dot"></span>
                        <p>Paket sampai ke penerima</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="right">
            <p>No Resi:</p>
            <span>xxxxxxxxxxxxxxxxxxxx</span>
        </div>
    </div>

</div>

</body>
</html>
