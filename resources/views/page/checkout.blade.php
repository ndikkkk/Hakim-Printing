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

        <form action="{{ route('order.confirm') }}" method="POST" id="checkoutForm">
            @csrf

            {{-- 1. ALAMAT PEMESAN --}}
            <div class="alamat">
                <h4 class="title-icon">
                    <img src="{{ asset('images/location.png') }}">
                    Alamat Pengiriman
                </h4>
                <p>
                    <strong>{{ $customer['customer_name'] }}</strong> ({{ $customer['customer_phone'] }})<br>
                    {{ $customer['customer_address'] }}
                </p>
            </div>

            {{-- 2. DETAIL PRODUK (Disimulasikan, karena kita belum simpan produk yang dipilih di session) --}}
            @php
                $product = Session::get('selected_product');
                $hargaSatuan = $product['price'] ?? 0;
            @endphp

            <div class="produk-item">
                <div class="produk-img">
                    <img src="{{ asset('images/' . $product['image']) }}">
                </div>
                <div class="produk-detail">
                    <h4>{{ $product['name'] ?? 'Produk Tidak Terpilih' }}</h4>
                    <p class="harga">Rp {{ number_format($hargaSatuan, 0, ',', '.') }}</p>
                    <p class="jumlah">x {{ $customer['quantity'] }} lembar</p>
                </div>
            </div>

            {{-- 3. INFORMASI UNDANGAN --}}
            <div class="informasi">
                <h4 class="title-icon">
                    <img src="{{ asset('images/note.png') }}">
                    Informasi Undangan
                </h4>
                <div class="info-item"><span>Nama Pria</span><span>{{ $invitation['groom_name'] ?? '-' }}</span></div>
                <div class="info-item"><span>Nama Wanita</span><span>{{ $invitation['bride_name'] ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span>Akad:</span>
                    <span>{{ $invitation['akad_date'] }} ({{ $invitation['akad_time'] }})</span>
                </div>
                <div class="info-item">
                    <span>Maps Akad:</span>
                    <span><a href="{{ $invitation['akad_location'] }}" target="_blank">Buka Maps</a></span>
                </div>
                <div class="info-item">
                    <span>Resepsi:</span>
                    <span>{{ $invitation['event_date'] }} ({{ $invitation['event_time'] }})</span>
                </div>
                <div class="info-item">
                    <span>Maps Resepsi:</span>
                    <span><a href="{{ $invitation['location_maps'] }}" target="_blank">Buka Maps</a></span>
                </div>
            </div>

            {{-- 4. PENGIRIMAN (API RAJAONGKIR) --}}
            <div class="pengiriman">
                <h4 class="title-icon">
                    <img src="{{ asset('images/shipping.png') }}">
                    Pengiriman (Kurir: JNE)
                </h4>

                <select name="shipping_cost" id="shipping_cost" required
                    style="width: 100%; padding: 10px; margin-top: 10px; border-radius: 5px; border: 1px solid #ccc; font-family: 'Poppins', sans-serif;">
                    <option value="" data-harga="0">Pilih Layanan JNE</option>
                    @if (empty($costs))
                        <option value="" data-harga="0">Gagal memuat ongkos kirim. Silakan refresh.</option>
                    @else
                        @foreach ($costs as $cost)
                            {{-- Sesuaikan dengan format array Komerce --}}
                            <option value="{{ $cost['cost'] }}" data-harga="{{ $cost['cost'] }}">
                                {{ $cost['name'] }} ({{ $cost['service'] }}) - Rp
                                {{ number_format($cost['cost'], 0, ',', '.') }}
                                (Estimasi: {{ $cost['etd'] }})
                            </option>
                        @endforeach
                    @endif
                </select>

                <div class="pengiriman-detail" style="margin-top: 10px;">
                    <span>Total Berat: {{ $weight / 1000 }} kg ({{ $weight }} gr)</span>
                    <span id="tampil_ongkir">Rp 0</span>
                </div>
            </div>

            {{-- 5. CATATAN & TOTAL PRODUK (NOTA / RECEIPT) --}}
            <div class="catatan"
                style="background: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                @php $totalHargaProduk = $hargaSatuan * $customer['quantity']; @endphp

                <div class="catatan-item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Total Produk ({{ $customer['quantity'] }} lembar)</span>
                    <span>Rp {{ number_format($totalHargaProduk, 0, ',', '.') }}</span>
                </div>

                <div class="catatan-item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Ongkos Kirim</span>
                    <span id="receipt_ongkir">Rp 0</span>
                </div>

                <hr style="margin: 15px 0; border: none; border-top: 1px dashed #ccc;">

                <div class="catatan-item"
                    style="display: flex; justify-content: space-between; font-weight: bold; font-size: 1.1em; color: #b0435e;">
                    <span>Total Tagihan</span>
                    <span id="receipt_total">Rp {{ number_format($totalHargaProduk, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- 6. METODE PEMBAYARAN --}}
            <div class="payment">
                <h4 class="title-icon">
                    <img src="{{ asset('images/payment.png') }}">
                    Metode Pembayaran
                </h4>
                <select name="payment_method" required
                    style="width: 100%; padding: 10px; margin-top: 10px; border-radius: 5px; border: 1px solid #ccc; font-family: 'Poppins', sans-serif;">
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="BCA">BCA - 1234567890</option>
                    <option value="BRI">BRI - 0987654321</option>
                    <option value="DANA">DANA - 081234567890</option>
                    <option value="GOPAY">GoPay - 081234567890</option>
                    <option value="MANDIRI">Mandiri - 1122334455</option>
                </select>
            </div>

            {{-- 7. CHECKOUT BAR (TOTAL AKHIR) --}}
            <div class="checkout-bar">
                <div class="total">
                    <p>Total Pembayaran</p>
                    {{-- Ini akan di-update otomatis oleh Javascript --}}
                    <span id="total_pembayaran">Rp {{ number_format($totalHargaProduk, 0, ',', '.') }}</span>

                    {{-- Input tersembunyi untuk dikirim ke backend --}}
                    <input type="hidden" name="grand_total" id="input_grand_total" value="{{ $totalHargaProduk }}">
                </div>

                <button type="submit"
                    style="background-color: #b0435e; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer;">
                    Checkout
                </button>
            </div>

        </form>
    </div>

    {{-- SCRIPT MENGHITUNG TOTAL HARGA OTOMATIS SAAT ONGKIR DIPILIH --}}
    <script>
        // Ambil harga total produk dari PHP ke dalam Javascript
        const hargaProduk = {{ $totalHargaProduk }};

        // Ambil elemen HTML yang dibutuhkan
        const selectOngkir = document.getElementById('shipping_cost');
        const tampilOngkir = document.getElementById('tampil_ongkir'); // yang di kotak pengiriman
        const tampilTotal = document.getElementById('total_pembayaran'); // yang di bar bawah
        const inputGrandTotal = document.getElementById('input_grand_total');

        // === TAMBAHAN UNTUK NOTA (RECEIPT) ===
        const receiptOngkir = document.getElementById('receipt_ongkir');
        const receiptTotal = document.getElementById('receipt_total');
        // =====================================

        // Event saat dropdown ongkir diubah
        selectOngkir.addEventListener('change', function() {
            // Ambil harga ongkir dari attribute 'data-harga' pada option yang dipilih
            const hargaOngkir = parseInt(this.options[this.selectedIndex].getAttribute('data-harga')) || 0;

            // Hitung Grand Total
            const grandTotal = hargaProduk + hargaOngkir;

            // Format ke Rupiah (Ribuan)
            const formatOngkir = 'Rp ' + hargaOngkir.toLocaleString('id-ID');
            const formatTotal = 'Rp ' + grandTotal.toLocaleString('id-ID');

            // Update semua tulisan di layar
            tampilOngkir.innerText = formatOngkir;
            tampilTotal.innerText = formatTotal;

            // === UPDATE TULISAN DI NOTA RECEIPT ===
            receiptOngkir.innerText = formatOngkir;
            receiptTotal.innerText = formatTotal;
            // ======================================

            // Update input hidden untuk dikirim saat checkout
            inputGrandTotal.value = grandTotal;
        });
    </script>

</body>

</html>
