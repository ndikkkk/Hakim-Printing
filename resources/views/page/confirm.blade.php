<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi</title>

    <link rel="stylesheet" href="{{ asset('css/style-confirm.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <img src="{{ asset('images/logo.png') }}" class="logo">

    <form action="{{ route('logoutconfirm') }}" method="POST">
        @csrf
        <button type="submit" class="logout-link">
            <img src="{{ asset('images/logout.png') }}" class="logout-icon">
            Sign Out
        </button>
    </form>
</nav>

<section class="hero" style="background: url('{{ asset('images/img2.jpeg') }}') no-repeat center/cover;">
    <div class="bubble">
        <h2>Terima Kasih!</h2>

        <p>Pesanan Anda telah diterima!</p>
        <p>Dan akan segera diproses sesuai antrian :)</p>

        <a href="{{ route('page.user-page') }}" class="link">
            Cek status pesanan Anda di sini
        </a>
    </div>
</section>

</body>
</html>
