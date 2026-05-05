<!DOCTYPE html>
<html>
<head>
    <title>Order Data Page</title>
    <link rel="stylesheet" href="{{ asset('css/style-orderdata.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4c3b1f73a2.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="navbar">
    {{-- hapus sementara --}}
    {{-- <img src="{{ asset('images/logo.png') }}"> --}}
    <h2>Data Pesanan</h2>
</div>

<div class="bg">
    <div class="pink-top"></div>
    <div class="white-middle"></div>
    <div class="pink-bottom"></div>
</div>

<div class="card-container">
    <div class="card">
        <form action="{{ route('order.data.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <div class="input-box">
                    <i class="fa fa-user"></i>
                    <input type="text" name="customer_name" value="{{ old('customer_name', $orderData['customer_name'] ?? '') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email Pemesan</label>
                <div class="input-box">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="customer_email" value="{{ old('customer_email', $orderData['customer_email'] ?? '') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Nomor WhatsApp</label>
                <div class="input-box">
                    <i class="fa fa-whatsapp"></i>
                    <input type="number" name="customer_phone" value="{{ old('customer_phone', $orderData['customer_phone'] ?? '') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Provinsi Tujuan</label>
                <div class="input-box">
                    <i class="fa fa-map"></i>
                    <select name="province_id" id="province" required style="width:100%; border:none; outline:none; background:transparent;">
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach($provinces as $prov)
                            <option value="{{ $prov['id'] }}">{{ $prov['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Kota/Kabupaten Tujuan</label>
                <div class="input-box">
                    <i class="fa fa-map-pin"></i>
                    <select name="city_id" id="city" required style="width:100%; border:none; outline:none; background:transparent;">
                        <option value="">-- Pilih Kota --</option>
                        {{-- Akan diisi otomatis oleh Javascript di bawah --}}
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Alamat Lengkap (Jalan, RT/RW)</label>
                <div class="input-box">
                    <i class="fa fa-home"></i>
                    <input type="text" name="customer_address" value="{{ old('customer_address', $orderData['customer_address'] ?? '') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Jumlah Pesanan (Pcs)</label>
                <div class="input-box">
                    <i class="fa fa-calculator"></i>
                    <input type="number" name="quantity" min="1" value="{{ old('quantity', $orderData['quantity'] ?? '100') }}" required>
                </div>
            </div>

            <div class="btn">
                <button type="submit">Lanjut ke Checkout</button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT AJAX UNTUK MENGAMBIL KOTA SAAT PROVINSI DIPILIH --}}
<script>
    document.getElementById('province').addEventListener('change', function() {
        let provinceId = this.value;
        let citySelect = document.getElementById('city');

        citySelect.innerHTML = '<option value="">Loading...</option>';

        if(provinceId) {
            fetch('/order/get-cities/' + provinceId)
            .then(response => response.json())
            .then(data => {
                console.log("Isi Jeroan Komerce:", data); // Biar kelihatan aslinya

                // 1. CEK ERROR DARI KOMERCE
                if (data.meta && data.meta.status === "error" || data.meta.code !== 200) {
                    // Tampilkan pesan errornya Komerce langsung di dalam kotak dropdown!
                    citySelect.innerHTML = `<option value="">Error: ${data.meta.message}</option>`;
                    return;
                }

                // 2. JIKA SUKSES, TAMPILKAN KOTA
                let cities = data.data || [];
                citySelect.innerHTML = '<option value="">-- Pilih Kota --</option>';

                if (cities.length === 0) {
                    citySelect.innerHTML = '<option value="">Kota tidak ditemukan</option>';
                } else {
                    cities.forEach(city => {
                        citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                    });
                }
            })
            .catch(error => {
                console.error('Error Fetch:', error);
                citySelect.innerHTML = '<option value="">Gagal menghubungi server lokal</option>';
            });
        } else {
            citySelect.innerHTML = '<option value="">-- Pilih Kota --</option>';
        }
    });
</script>

</body>
</html>
