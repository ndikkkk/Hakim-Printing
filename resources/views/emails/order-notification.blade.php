<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Pesanan - Hakim Printing</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #b0435e; text-align: center;">Hakim Printing</h2>
        <p>Halo pelanggan yang terhormat,</p>
        <p>{{ $messageContent }}</p>

        <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin-top: 20px;">
            <h4 style="margin-top: 0;">Detail Pesanan:</h4>
            <p><strong>Nomor Order:</strong> {{ $order->order_number }}</p>
            <p><strong>Status Pembayaran:</strong> {{ strtoupper($order->payment_status) }}</p>
            @if($order->resi)
                <p><strong>Nomor Resi:</strong> {{ $order->resi }}</p>
            @endif
            <p><strong>Total Tagihan:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>

        <p style="margin-top: 20px;">Terima kasih telah mempercayakan cetakan undangan Anda kepada Hakim Printing!</p>
    </div>
</body>
</html>
