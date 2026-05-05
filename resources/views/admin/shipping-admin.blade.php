<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesanan Dikirim</title>

    <link rel="stylesheet" href="{{ asset('css/style-shipping.css') }}">
</head>

<body>

    <div class="header">
        {{-- hapus sementara --}}
        {{-- <img src="{{ asset('images/logo.png') }}"> --}}

        <h2>Pesanan yang Dikirim</h2>

        <a href="/admin" class="back">Back</a>
    </div>

    <div class="container">
        @if (isset($orders) && $orders->count() > 0)
            @foreach ($orders as $order)
                <div class="order-card">
                    <div class="left">
                        {{-- Ganti John Doe dengan ID User atau Order Number --}}
                        <h4>Order: {{ $order->order_number }}</h4>

                        {{-- Nanti bisa panggil relasi produk: $order->product->name --}}
                        <p>ID Produk: {{ $order->product_id }}</p>
                        <p>x {{ $order->quantity }} lembar</p>
                        <p class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>

                    <div class="right">
                        <p>Status Pembayaran:</p>
                        <span
                            style="font-weight: bold; color: {{ $order->payment_status == 'success' ? 'green' : 'orange' }};">
                            {{ strtoupper($order->payment_status) }}
                        </span>

                        <p style="margin-top: 10px;">No Resi:</p>
                        <span>{{ $order->resi ?? 'Belum ada resi' }}</span>
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align: center;">Belum ada pesanan yang diproses.</p>
        @endif
    </div>

</body>

</html>
