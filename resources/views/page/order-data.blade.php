<!DOCTYPE html>
<html>
<head>
    <title>Order Data Page</title>

    <link rel="stylesheet" href="{{ asset('css/style-orderdata.css') }}">

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    {{-- ICON --}}
    <script src="https://kit.fontawesome.com/4c3b1f73a2.js" crossorigin="anonymous"></script>
</head>
<body>

{{-- HEADER --}}
<div class="navbar">
    <img src="{{ asset('images/logo.png') }}">
    <h2>Data Pesanan</h2>
</div>

{{-- BACKGROUND LAYER --}}
<div class="bg">
    <div class="pink-top"></div>
    <div class="white-middle"></div>
    <div class="pink-bottom"></div>
</div>

{{-- CARD (FLOATING) --}}
<div class="card-container">
    <div class="card">

        <form action="{{ route('order.data.process') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Lengkap Pemesan</label>
        <div class="input-box">
            <input type="text" name="customer_name" value="{{ old('customer_name', $orderData['customer_name'] ?? '') }}" required>
        </div>
    </div>

    <div class="form-group">
        <label>Email</label>
        <div class="input-box">
            <input type="email" name="customer_email" value="{{ old('customer_email', $orderData['customer_email'] ?? '') }}" required>
        </div>
    </div>

    <div class="form-group">
        <label>Nomor WhatsApp</label>
        <div class="input-box">
            <input type="number" name="customer_phone" value="{{ old('customer_phone', $orderData['customer_phone'] ?? '') }}" required>
        </div>
    </div>

    <div class="form-group">
        <label>Jumlah Pesanan (Pcs)</label>
        <div class="input-box">
            <input type="number" name="quantity" value="{{ old('quantity', $orderData['quantity'] ?? '100') }}" min="1" required>
            @error('quantity') <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Alamat Lengkap Pengiriman</label>
        <div class="input-box">
            <textarea name="customer_address" required>{{ old('customer_address', $orderData['customer_address'] ?? '') }}</textarea>
        </div>
    </div>

    {{-- Untuk sementara Province & City pakai input text dulu sebelum kita konek RajaOngkir --}}
    <input type="hidden" name="province_id" value="1"> {{-- Dummy --}}
    <input type="hidden" name="city_id" value="1">     {{-- Dummy --}}

    <div class="btn">
        <button type="submit">Selanjutnya</button>
    </div>
</form>

    </div>
</div>

</body>
</html>
