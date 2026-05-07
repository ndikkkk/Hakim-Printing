<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="{{ asset('css/style-addproduct.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body>

<nav class="header">
    <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    <h2>Edit Produk</h2>
    <a href="{{ route('admin.product.list') }}" class="back">Back</a>
</nav>

<div class="container">

    @if($errors->any())
        <ul style="color:red; text-align:center; margin-bottom:1rem;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form class="form" action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label>Kode Produk</label>
                <input type="text" name="product_code" value="{{ old('product_code', $product->product_code) }}">
            </div>

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}">
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <input type="text" name="description" value="{{ old('description', $product->description) }}">
            </div>

            <div class="form-group">
                <label>Foto Produk (kosongkan jika tidak diganti)</label>
                <input type="file" name="image" accept="image/*">
            </div>

        </div>

        <div class="btn-container">
            <button type="submit">Simpan Perubahan</button>
        </div>

    </form>
</div>

</body>
</html>
