<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="{{ asset('css/style-history.css') }}">
    <style>
        .product-actions { display: flex; gap: 8px; margin-top: 8px; }
        .btn-edit  { padding: 6px 14px; background: #f0a500; color: #fff; border: none; border-radius: 4px; text-decoration: none; font-size: 13px; }
        .btn-hapus { padding: 6px 14px; background: #e53e3e; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; }
        .btn-tambah { display: inline-block; margin: 1rem 0; padding: 8px 18px; background: #2d7a2d; color: #fff; border-radius: 4px; text-decoration: none; font-size: 14px; }
    </style>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body>

    <div class="header">
        <h2>Daftar Produk</h2>
        <a href="/admin" class="back">Back</a>
    </div>

    <div class="container">

        @if(session('success'))
            <p style="color:green; text-align:center; margin-bottom:1rem;">{{ session('success') }}</p>
        @endif

        <a href="{{ route('admin.product.add') }}" class="btn-tambah">+ Tambah Produk</a>

        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="order-card">
                    <div class="left">
                        <h4>{{ $product->name }}</h4>
                        <p>Kode: {{ $product->product_code }}</p>
                        <p>{{ $product->description }}</p>
                        <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="product-actions">
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn-edit">Edit</a>
                            <form id="del-form-{{ $product->id }}" action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-hapus" onclick="showDeleteModal('del-form-{{ $product->id }}')">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <img src="{{ Str::startsWith($product->image, 'products/') ? asset('storage/' . $product->image) : asset('images/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             style="width:80px; height:80px; object-fit:cover; border-radius:6px;">
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align:center;">Belum ada produk.</p>
        @endif
    </div>

</body>

{{-- Custom Delete Modal --}}
<div id="deleteModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:12px; padding:30px; width:320px; text-align:center; box-shadow:0 8px 32px rgba(0,0,0,0.2);">
        <p style="font-size:16px; font-weight:600; margin:0 0 8px;">Hapus Produk</p>
        <p style="font-size:14px; color:#666; margin:0 0 24px;">Produk akan dihapus permanen. Lanjutkan?</p>
        <div style="display:flex; gap:12px; justify-content:center;">
            <button onclick="closeDeleteModal()" style="padding:10px 24px; border:1px solid #ccc; border-radius:8px; background:#fff; cursor:pointer; font-size:14px;">Batal</button>
            <button onclick="submitDeleteForm()" style="padding:10px 24px; border:none; border-radius:8px; background:#e53e3e; color:#fff; cursor:pointer; font-size:14px; font-weight:600;">Hapus</button>
        </div>
    </div>
</div>

<script>
let _deleteFormId = null;
function showDeleteModal(formId) {
    _deleteFormId = formId;
    document.getElementById('deleteModal').style.display = 'flex';
}
function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    _deleteFormId = null;
}
function submitDeleteForm() {
    if (_deleteFormId) document.getElementById(_deleteFormId).submit();
}
</script>

</html>
