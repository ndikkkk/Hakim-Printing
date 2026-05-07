<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesanan Dikirim</title>

    <link rel="stylesheet" href="{{ asset('css/style-shipping.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
        <h2>Pesanan yang Dikirim</h2>
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
                            <div class="timeline">
                                <div class="step {{ is_null($order->shipping_status) ? 'active' : '' }}">
                                    <span class="dot"></span>
                                    <p>Paket sedang di jalan</p>
                                </div>
                                <div class="step {{ $order->shipping_status === 'in_transit' ? 'active' : '' }}">
                                    <span class="dot"></span>
                                    <p>Paket sampai kota tujuan dan akan segera dikirim ke alamat</p>
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
                        <span>{{ $order->resi }}</span>

                        {{-- Tombol konfirmasi terima — hanya muncul jika sudah in_transit --}}
                        @if($order->shipping_status === 'in_transit')
                        <form action="{{ route('user.confirm-received', $order->id) }}" method="POST"
                            style="margin-top: 15px;">
                            @csrf
                            <button type="button"
                                onclick="showConfirmModal(this.form)"
                                style="background-color: #b0435e; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-weight: bold; width: 100%;">
                                Konfirmasi Terima
                            </button>
                        </form>
                        @else
                        <p style="margin-top:10px; font-size:12px; color:#888; font-style:italic;">
                            Menunggu paket tiba di alamat Anda...
                        </p>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align: center; color: #666; padding: 40px 0;">
                Belum ada pesanan yang sedang dikirim.
            </p>
        @endif

    </div>

{{-- Custom Confirm Modal --}}
<div id="confirmModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:12px; padding:30px; width:320px; text-align:center; box-shadow:0 8px 32px rgba(0,0,0,0.2);">
        <p style="font-size:16px; font-weight:600; margin:0 0 8px;">Konfirmasi Penerimaan</p>
        <p style="font-size:14px; color:#666; margin:0 0 24px;">Apakah pesanan sudah diterima dengan baik?</p>
        <div style="display:flex; gap:12px; justify-content:center;">
            <button onclick="closeConfirmModal()" style="padding:10px 24px; border:1px solid #ccc; border-radius:8px; background:#fff; cursor:pointer; font-size:14px;">Batal</button>
            <button onclick="submitConfirmForm()" style="padding:10px 24px; border:none; border-radius:8px; background:#b0435e; color:#fff; cursor:pointer; font-size:14px; font-weight:600;">Ya, Sudah Diterima</button>
        </div>
    </div>
</div>

<script>
let _pendingForm = null;
function showConfirmModal(form) {
    _pendingForm = form;
    const modal = document.getElementById('confirmModal');
    modal.style.display = 'flex';
}
function closeConfirmModal() {
    document.getElementById('confirmModal').style.display = 'none';
    _pendingForm = null;
}
function submitConfirmForm() {
    if (_pendingForm) _pendingForm.submit();
}
</script>

</body>

</html>
