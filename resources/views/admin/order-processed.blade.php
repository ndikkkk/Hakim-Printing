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

    <div class="order-card">
        <div class="left">
            <h4>John Doe</h4>
            <p>Product A</p>
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
            <h4>Jane Smith</h4>
            <p>Product B</p>
            <p>x 150</p>
            <p class="price">Rp. xxxxx,xx</p>
        </div>

        <div class="right">
            <p>No Resi:</p>
            <span>yyyyyyyyyyyyyyyyyyyy</span>
        </div>
    </div>

</div>

</body>
</html>
