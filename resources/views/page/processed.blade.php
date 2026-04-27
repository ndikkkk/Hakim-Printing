<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Diproses</title>

    <link rel="stylesheet" href="{{ asset('css/style-processed.css') }}">
</head>
<body>

<div class="header">
    <img src="{{ asset('images/logo.png') }}" class="logo">

    <h2>Pesanan Diproses</h2>

    <a href="{{ route('page.user-page') }}" class="back">Back</a>
</div>

<div class="container">

    <div class="order-card">
        <div class="left">
            <h4>Product A</h4>
            <p>x 200</p>
            <p class="price">Rp. xxxxx,xx</p>
        </div>
        <div class="right">
            <p>No Resi:</p>
            <span>xxxxxxxxxxxxxxxxxxxx</span>
        </div>
    </div>

    <div class="order-card">
        <div class="left">
            <h4>Product A</h4>
            <p>x 200</p>
            <p class="price">Rp. xxxxx,xx</p>
        </div>
        <div class="right">
            <p>No Resi:</p>
            <span>xxxxxxxxxxxxxxxxxxxx</span>
        </div>
    </div>

    <div class="order-card">
        <div class="left">
            <h4>Product A</h4>
            <p>x 200</p>
            <p class="price">Rp. xxxxx,xx</p>
        </div>
        <div class="right">
            <p>No Resi:</p>
            <span>xxxxxxxxxxxxxxxxxxxx</span>
        </div>
    </div>

</div>

</body>
</html>
