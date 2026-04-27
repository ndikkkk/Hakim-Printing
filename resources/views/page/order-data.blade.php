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

        <form action="/information" method="GET">

            {{-- NAMA --}}
            <div class="form-group">
                <label>Nama Lengkap</label>
                <div class="input-box">
                    <i class="fa fa-user"></i>
                    <input type="text" name="nama">
                </div>
            </div>

            {{-- WHATSAPP --}}
            <div class="form-group">
                <label>No. WhatsApp</label>
                <div class="input-box">
                    <i class="fa fa-whatsapp"></i>
                    <input type="text" name="whatsapp">
                </div>
            </div>

            {{-- ALAMAT --}}
            <div class="form-group">
                <label>Alamat</label>
                <div class="input-box">
                    <i class="fa fa-home"></i>
                    <input type="text" name="alamat">
                </div>
            </div>

            {{-- JUMLAH --}}
            <div class="form-group">
                <label>Jumlah Pesanan</label>
                <div class="input-box">
                    <i class="fa fa-calculator"></i>
                    <input type="number" name="jumlah">
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="btn">
                <button type="submit">Selanjutnya</button>
            </div>

        </form>

    </div>
</div>

</body>
</html>
