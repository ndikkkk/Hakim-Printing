<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Diproses</title>

    <link rel="stylesheet" href="{{ asset('css/style-processed.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body>

<div class="header">
    <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    <h2>Pesanan Diproses</h2>
    <a href="{{ route('page.user') }}" class="back">Back</a>
</div>

<div class="container">

    @if(isset($orders) && $orders->count() > 0)
        @foreach($orders as $order)
            <div class="order-card">
                <div class="left">
                    <h4>{{ $order->order_number }}</h4>
                    <p>x {{ $order->quantity }} lembar</p>
                    <p class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>
                <div class="right">
                    <p>Status Pembayaran:</p>
                    <span style="font-weight: bold; color: #28a745;">LUNAS</span>
                    <p style="margin-top: 10px;">Resi:</p>
                    <span style="color: #999; font-style: italic;">Menunggu admin input resi...</span>
                </div>
            </div>
        @endforeach
    @else
        <p style="text-align: center; color: #666; padding: 40px 0;">
            Tidak ada pesanan yang sedang diproses.
        </p>
    @endif

</div>

</body>
</html>
