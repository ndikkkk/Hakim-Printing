<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesanan Diproses</title>

    <link rel="stylesheet" href="{{ asset('css/style-orderprocessed.css') }}">
</head>

<body>

    <div class="header">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
        <h2>Pesanan Diproses</h2>
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
                        <p style="margin-bottom: 5px;">Input No Resi:</p>
                        <form action="{{ route('admin.order.resi', $order->id) }}" method="POST">
                            @csrf
                            <input type="text" name="resi" placeholder="Masukkan Resi JNE" required
                                style="padding: 8px; width: 100%; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;">

                            <button type="submit"
                                style="background-color: #b0435e; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; width: 100%; font-weight: bold;">
                                Kirim Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align: center;">Belum ada pesanan yang diproses.</p>
        @endif
    </div>

</body>

</html>
