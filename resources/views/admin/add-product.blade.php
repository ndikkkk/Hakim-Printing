<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="{{ asset('css/style-addproduct.css') }}">
</head>
<body>

<nav class="header">
    <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    <h2>Tambah Produk</h2>
    <a href="/admin" class="back">Back</a>
</nav>

<div class="container">
    <form class="form">

        <div class="form-grid">

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" placeholder="Masukkan nama produk">
            </div>

            <div class="form-group">
                <label>Ketebalan Kertas</label>
                <input type="text" placeholder="Masukkan ketebalan kertas">
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="text" placeholder="Rp 0">
            </div>

            <div class="form-group">
                <label>Jumlah Halaman</label>
                <input type="text" placeholder="Jumlah halaman">
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <input type="text" placeholder="Deskripsi singkat">
            </div>

            <div class="form-group">
                <label>Minimal Order</label>
                <input type="text" placeholder="Jumlah minimal order">
            </div>

            <div class="form-group">
                <label>Ukuran Undangan</label>
                <input type="text" placeholder="Contoh: 10x15 cm">
            </div>

            <div class="form-group">
                <label>Foto Produk</label>
                <input type="file">
            </div>

            <div class="form-group">
                <label>Jenis Kertas</label>
                <input type="text" placeholder="Contoh: Art Paper">
            </div>

        </div>

        <div class="btn-container">
            <button type="submit">Tambah Produk</button>
        </div>

    </form>
</div>

<div id="successModal" class="modal">
    <div class="modal-content">
        <p>Produk berhasil ditambahkan!</p>
        <button class="close-btn">Tutup</button>
    </div>
</div>

<script>
const form = document.querySelector('.form');
const modal = document.getElementById('successModal');
const closeBtn = document.querySelector('.close-btn');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    modal.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});
</script>

</body>
</html>
