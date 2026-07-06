<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Hakim Printing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body {
            background: url('{{ asset('images/img2.jpeg') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #333;
        }
        .overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(255,245,230,0.8), rgba(255,255,255,0.9));
            z-index: -1;
        }
        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 5%; background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 4px 10px rgba(0,0,0,0.02); position: sticky; top: 0; z-index: 10;
        }
        .back-btn {
            display: flex; align-items: center; gap: 8px; text-decoration: none;
            color: #b6895b; font-weight: 500; font-size: 14px;
            background: rgba(255, 255, 255, 0.7); padding: 8px 15px;
            border-radius: 20px; transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .back-btn:hover { background: #b6895b; color: #fff; transform: translateX(-3px); }
        .nav-title { font-weight: 600; font-size: 1.2rem; color: #555; }
        
        .container { flex: 1; padding: 40px 5%; display: flex; justify-content: center; }
        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 1);
            border-radius: 24px; padding: 40px; width: 100%; max-width: 600px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            margin-bottom: 50px;
        }
        
        .section-title {
            display: flex; align-items: center; gap: 10px;
            font-size: 1.1rem; color: #b6895b; font-weight: 600;
            margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 2px dashed rgba(182, 137, 91, 0.3);
        }
        .section-title img { width: 20px; opacity: 0.8; }
        
        .info-box {
            background: rgba(255, 255, 255, 0.9); border-radius: 12px; padding: 15px;
            border: 1px solid rgba(182, 137, 91, 0.2); margin-bottom: 15px;
        }
        .info-box p { font-size: 0.95rem; line-height: 1.6; color: #555; }
        
        .product-item {
            display: flex; gap: 20px; align-items: center; background: rgba(255, 255, 255, 0.9);
            padding: 15px; border-radius: 12px; border: 1px solid rgba(182, 137, 91, 0.2); margin-bottom: 15px;
        }
        .product-item img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; }
        .product-detail h4 { font-size: 1.1rem; color: #333; margin-bottom: 5px; }
        .product-detail .harga { font-weight: 600; color: #b6895b; }
        .product-detail .jumlah { font-size: 0.9rem; color: #777; }
        
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.9rem; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 5px; }
        .detail-row:last-child { border: none; margin-bottom: 0; padding-bottom: 0; }
        .detail-row span:first-child { color: #666; }
        .detail-row span:last-child { font-weight: 500; color: #333; text-align: right; }
        .detail-row a { color: #b6895b; text-decoration: none; font-weight: 600; }
        
        select {
            width: 100%; padding: 12px 15px;
            border: 1px solid rgba(182, 137, 91, 0.3);
            border-radius: 12px; background: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem; color: #333; transition: all 0.3s ease;
            outline: none; cursor: pointer; margin-bottom: 10px;
        }
        select:focus { border-color: #b6895b; box-shadow: 0 0 0 3px rgba(182, 137, 91, 0.1); }
        
        .receipt {
            background: linear-gradient(145deg, #ffffff, #fdfbf7); padding: 20px;
            border-radius: 16px; border: 1px solid rgba(182, 137, 91, 0.2);
            box-shadow: 0 5px 15px rgba(0,0,0,0.02); margin-top: 30px;
        }
        .receipt .total-tagihan {
            font-size: 1.2rem; font-weight: 700; color: #b6895b;
            padding-top: 15px; margin-top: 15px; border-top: 2px dashed rgba(182, 137, 91, 0.3);
        }
        
        .checkout-bar {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            padding: 15px 5%; display: flex; justify-content: flex-end; align-items: center; gap: 20px;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.05); border-top: 1px solid rgba(255, 255, 255, 0.5); z-index: 10;
        }
        .checkout-bar .total-info { text-align: right; }
        .checkout-bar .total-info p { font-size: 0.85rem; color: #666; margin-bottom: 2px; }
        .checkout-bar .total-info span { font-size: 1.3rem; font-weight: 700; color: #b6895b; }
        .btn-submit {
            padding: 12px 30px; background: linear-gradient(135deg, #b6895b, #a37a51);
            color: #fff; border: none; border-radius: 30px; font-size: 1rem; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(182, 137, 91, 0.3);
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(182, 137, 91, 0.4); }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <nav class="navbar">
        <a href="{{ route('order.data') }}" class="back-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <div class="nav-title">Checkout Pesanan</div>
        <div style="width: 80px;"></div>
    </nav>

    <div class="container">
        <div class="card">
            <form action="{{ route('order.checkout.process') }}" method="POST" id="checkoutForm">
                @csrf

                <div class="section-title">
                    <img src="{{ asset('images/location.png') }}">
                    Alamat Pengiriman
                </div>
                <div class="info-box">
                    <p>
                        <strong>{{ $customer['customer_name'] }}</strong> ({{ $customer['customer_phone'] }})<br>
                        {{ $customer['customer_address'] }}
                    </p>
                </div>

                @php
                    $product = Session::get('selected_product');
                    $hargaSatuan = $product['price'] ?? 0;
                    $totalHargaProduk = $hargaSatuan * $customer['quantity'];
                @endphp

                <div class="section-title">
                    <img src="{{ asset('images/note.png') }}">
                    Produk Terpilih
                </div>
                <div class="product-item">
                    <img src="{{ Str::startsWith($product['image'], 'products/') ? asset('storage/' . $product['image']) : asset('images/' . $product['image']) }}">
                    <div class="product-detail">
                        <h4>{{ $product['name'] ?? 'Produk Tidak Terpilih' }}</h4>
                        <p class="harga">Rp {{ number_format($hargaSatuan, 0, ',', '.') }}</p>
                        <p class="jumlah">x {{ $customer['quantity'] }} lembar</p>
                    </div>
                </div>

                <div class="section-title">
                    <img src="{{ asset('images/note.png') }}">
                    Informasi Undangan
                </div>
                <div class="info-box">
                    <div class="detail-row"><span>Nama Pria</span><span>{{ $invitation['groom_name'] ?? '-' }}</span></div>
                    <div class="detail-row"><span>Nama Wanita</span><span>{{ $invitation['bride_name'] ?? '-' }}</span></div>
                    <div class="detail-row"><span>Akad</span><span>{{ $invitation['akad_date'] }} ({{ $invitation['akad_time'] }})</span></div>
                    <div class="detail-row"><span>Maps Akad</span><span><a href="{{ $invitation['akad_location'] }}" target="_blank">Buka Maps</a></span></div>
                    <div class="detail-row"><span>Resepsi</span><span>{{ $invitation['event_date'] }} ({{ $invitation['event_time'] }})</span></div>
                    <div class="detail-row"><span>Maps Resepsi</span><span><a href="{{ $invitation['location_maps'] }}" target="_blank">Buka Maps</a></span></div>
                </div>

                <div class="section-title">
                    <img src="{{ asset('images/shipping.png') }}">
                    Pengiriman
                </div>
                <select name="shipping_cost" id="shipping_cost" required>
                    <option value="" data-harga="0">Pilih Layanan Pengiriman</option>
                    @if (empty($costs))
                        <option value="" data-harga="0">Gagal memuat ongkos kirim. Silakan refresh.</option>
                    @else
                        @foreach ($costs as $cost)
                            <option value="{{ $cost['cost'] }}" data-harga="{{ $cost['cost'] }}">
                                {{ strtoupper($cost['name'] ?? '') }} - {{ $cost['service'] }} - Rp
                                {{ number_format($cost['cost'], 0, ',', '.') }}
                                (Estimasi: {{ $cost['etd'] }})
                            </option>
                        @endforeach
                    @endif
                </select>
                <div style="font-size: 0.9rem; color: #666; margin-top: 5px; text-align: right;">
                    Total Berat: {{ $weight / 1000 }} kg ({{ $weight }} gr) &nbsp;|&nbsp; Ongkir: <strong id="tampil_ongkir" style="color:#b6895b;">Rp 0</strong>
                </div>

                <div class="receipt">
                    <div class="detail-row">
                        <span>Total Produk ({{ $customer['quantity'] }} lembar)</span>
                        <span>Rp {{ number_format($totalHargaProduk, 0, ',', '.') }}</span>
                    </div>
                    <div class="detail-row">
                        <span>Ongkos Kirim</span>
                        <span id="receipt_ongkir">Rp 0</span>
                    </div>
                    <div class="detail-row total-tagihan">
                        <span>Total Tagihan</span>
                        <span id="receipt_total">Rp {{ number_format($totalHargaProduk, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="checkout-bar">
                    <div class="total-info">
                        <p>Total Pembayaran</p>
                        <span id="total_pembayaran">Rp {{ number_format($totalHargaProduk, 0, ',', '.') }}</span>
                        <input type="hidden" name="grand_total" id="input_grand_total" value="{{ $totalHargaProduk }}">
                    </div>
                    <button type="submit" class="btn-submit">Checkout &rarr;</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const hargaProduk = {{ $totalHargaProduk }};
        const selectOngkir = document.getElementById('shipping_cost');
        const tampilOngkir = document.getElementById('tampil_ongkir');
        const tampilTotal = document.getElementById('total_pembayaran');
        const inputGrandTotal = document.getElementById('input_grand_total');
        const receiptOngkir = document.getElementById('receipt_ongkir');
        const receiptTotal = document.getElementById('receipt_total');

        selectOngkir.addEventListener('change', function() {
            const hargaOngkir = parseInt(this.options[this.selectedIndex].getAttribute('data-harga')) || 0;
            const grandTotal = hargaProduk + hargaOngkir;

            const formatOngkir = 'Rp ' + hargaOngkir.toLocaleString('id-ID');
            const formatTotal = 'Rp ' + grandTotal.toLocaleString('id-ID');

            tampilOngkir.innerText = formatOngkir;
            tampilTotal.innerText = formatTotal;
            receiptOngkir.innerText = formatOngkir;
            receiptTotal.innerText = formatTotal;
            inputGrandTotal.value = grandTotal;
        });

        const formCheckout = document.getElementById('checkoutForm');
        formCheckout.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const btnSubmit = this.querySelector('button[type="submit"]');
            const originalText = btnSubmit.innerText;
            btnSubmit.innerText = "Memproses...";
            btnSubmit.disabled = true;

            fetch("{{ route('order.checkout.process') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    btnSubmit.innerText = originalText;
                    btnSubmit.disabled = false;
                    if (data.snap_token) {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                window.location.href = "/order/manual-success/" + result.order_id;
                            },
                            onPending: function(result) {
                                alert("Menunggu pembayaran Anda!");
                            },
                            onError: function(result) {
                                alert("Pembayaran gagal!");
                            },
                            onClose: function() {
                                alert('Anda membatalkan pembayaran. Silakan klik Checkout kembali jika ingin melanjutkan.');
                            }
                        });
                    } else {
                        alert('Gagal mendapatkan token pembayaran.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    btnSubmit.innerText = originalText;
                    btnSubmit.disabled = false;
                    alert('Terjadi kesalahan pada sistem.');
                });
        });
    </script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</body>
</html>
