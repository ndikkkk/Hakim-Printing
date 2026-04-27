<!DOCTYPE html>
<html>
<head>
    <title>Information Page</title>

    <link rel="stylesheet" href="{{ asset('css/style-info-invitation.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

{{-- HEADER --}}
<div class="navbar">
    <img src="{{ asset('images/logo.png') }}">
    <h2>Informasi Pesanan</h2>
</div>

{{-- BACKGROUND --}}
<div class="bg">
    <div class="pink-top"></div>
    <div class="white-middle"></div>
    <div class="pink-bottom"></div>
</div>

{{-- CARD --}}
<div class="card-container">
    <div class="card">

        <form action="/checkout" method="GET">

            <div class="form-group">
                <label>Nama Lengkap Mempelai Pria</label>
                <div class="input-box">
                    <input type="text" name="pria_nama">
                </div>
            </div>

            <div class="form-group">
                <label>Alamat Mempelai Pria</label>
                <div class="input-box">
                    <input type="text" name="pria_alamat">
                </div>
            </div>

            <div class="form-group">
                <label>Nama Orang Tua Mempelai Pria</label>
                <div class="input-box">
                    <input type="text" name="pria_ortu">
                </div>
            </div>

            <div class="form-group">
                <label>Nama Lengkap Mempelai Wanita</label>
                <div class="input-box">
                    <input type="text" name="wanita_nama">
                </div>
            </div>

            <div class="form-group">
                <label>Alamat Mempelai Wanita</label>
                <div class="input-box">
                    <input type="text" name="wanita_alamat">
                </div>
            </div>

            <div class="form-group">
                <label>Nama Orang Tua Mempelai Wanita</label>
                <div class="input-box">
                    <input type="text" name="wanita_ortu">
                </div>
            </div>

            <div class="form-group">
                <label>Tanggal Akad (Waktu Akad)</label>
                <div class="input-box">
                    <input type="text" name="akad_tanggal">
                </div>
            </div>

            <div class="form-group">
                <label>Lokasi Akad</label>
                <div class="input-box">
                    <input type="text" name="akad_lokasi">
                </div>
            </div>

            <div class="form-group">
                <label>Tanggal Resepsi (Waktu Resepsi)</label>
                <div class="input-box">
                    <input type="text" name="resepsi_tanggal">
                </div>
            </div>

            <div class="form-group">
                <label>Lokasi Resepsi</label>
                <div class="input-box">
                    <input type="text" name="resepsi_lokasi">
                </div>
            </div>

            <div class="form-group">
                <label>Quotes (Opsional)</label>
                <div class="input-box">
                    <input type="text" name="quotes">
                </div>
            </div>

            <div class="btn">
                <button type="submit">Checkout</button>
            </div>

        </form>

    </div>
</div>

</body>
</html>
