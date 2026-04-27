<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>

    <link rel="stylesheet" href="{{ asset('css/style-checkout.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

<div class="header">
    <h2>Checkout</h2>
</div>

<div class="content">

    <div class="alamat">
        <h4 class="title-icon">
            <img src="{{ asset('images/location.png') }}">
            Alamat
        </h4>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
    </div>

    <div class="section-pink">
        <div class="produk-item">
            <div class="produk-img">
                <img src="{{ asset('images/img2.jpeg') }}">
            </div>

            <div class="produk-detail">
                <h4>Produk A</h4>
                <p class="harga">Rp 20.000,00</p>
                <p class="jumlah">x 100</p>
            </div>
        </div>
    </div>

    <div class="informasi">
        <h4 class="title-icon">
            <img src="{{ asset('images/note.png') }}">
            Informasi Undangan
        </h4>

        <div class="info-item"><span>Nama Lengkap Mempelai Pria</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Alamat Mempelai Pria</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Nama Orang Tua Mempelai Pria</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Nama Lengkap Mempelai Wanita</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Alamat Mempelai Wanita</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Nama Orang Tua Mempelai Wanita</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Tanggal Akad (Waktu Akad)</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Lokasi Akad</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Tanggal Resepsi (Waktu Resepsi)</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Lokasi Resepsi</span><span>xxxxxxxxxxxxxxxx</span></div>
        <div class="info-item"><span>Quotes (Opsional)</span><span>xxxxxxxxxxxxxxxx</span></div>
    </div>

    <div class="pengiriman">
        <h4 class="title-icon">
            <img src="{{ asset('images/shipping.png') }}">
            Pengiriman
        </h4>

        <p class="kurir">RajaOngkir</p>

        <div class="pengiriman-detail">
            <span>xxx kg</span>
            <span>Rp. xxx</span>
        </div>
    </div>

    <div class="catatan">
        <div class="catatan-item">
            <span>Catatan:</span>
            <span>xxxxxxxxxx</span>
        </div>

        <div class="catatan-item">
            <span>Total Pesanan (xxx lembar)</span>
            <span>Rp. xxxxx,xx</span>
        </div>
    </div>

    <div class="payment">
        <h4 class="title-icon">
            <img src="{{ asset('images/payment.png') }}">
            Metode Pembayaran
        </h4>

        <select>
            <option value="">Pilih Metode Pembayaran</option>
            <option value="bca">BCA</option>
            <option value="bri">BRI</option>
            <option value="dana">DANA</option>
            <option value="gopay">GoPay</option>
            <option value="mandiri">Mandiri</option>
        </select>
    </div>

    <div class="checkout-bar">
        <div class="total">
            <p>Total Pembayaran</p>
            <span>Rp. XXX.XXX</span>
        </div>

        <a href="/konfirmasi">
            <button>Checkout</button>
        </a>
    </div>

</div>

<script>
function goFinish() {
    alert("Checkout berhasil (simulasi)");
}
</script>

<script>
function tampilMetode() {
    const select = document.getElementById("metode");
    const hasil = document.getElementById("hasil-metode");

    if (select.value !== "") {
        hasil.innerText = select.value;
    } else {
        hasil.innerText = "";
    }
}
</script>

</body>
</html>
