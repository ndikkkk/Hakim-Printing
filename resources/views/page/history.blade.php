<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesanan Selesai</title>

    <link rel="stylesheet" href="{{ asset('css/style-shipping.css') }}">
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        {{-- hapus sementara --}}
        {{-- <img src="{{ asset('images/logo.png') }}"> --}}

        <h2>Pesanan Selesai</h2>

        <a href="{{ route('page.user') }}" class="back">Back</a>
    </div>

    {{-- LIST PESANAN --}}
    <div class="container">

        @if (isset($orders) && $orders->count() > 0)
            @foreach ($orders as $order)
                <div class="order-card">
                    <div class="left">
                        <h4>{{ $order->order_number }}</h4>
                        <p>x {{ $order->quantity }} lembar</p>
                        <p class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                        <div class="shipping-status">
                            <div class="status-header">
                                <img src="{{ asset('images/shipping.png') }}" class="icon-img">
                                <p>Status Pengiriman</p>
                            </div>
                            <div class="status">
                                <span class="dot"></span>
                                <p>Paket sampai ke penerima</p>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <p>No Resi:</p>
                        <span>{{ $order->resi ?? '-' }}</span>
                        <p style="margin-top: 10px;">Status:</p>
                        <span style="font-weight: bold; color: #28a745;">✓ Diterima</span>
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align: center; color: #666; padding: 40px 0;">
                Belum ada pesanan yang selesai.
            </p>
        @endif

    </div>

</body>

</html>
