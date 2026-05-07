<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesanan Diproses</title>

    <link rel="stylesheet" href="{{ asset('css/style-orderprocessed.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>

    <div class="header">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
        <h2>Pesanan Diproses</h2>
        <a href="/admin" class="back">Back</a>
    </div>

    <div class="container">
        @if (isset($orders) && $orders->count() > 0)
            @foreach ($orders as $order)
                <div class="order-card">
                    <div class="left">
                        {{-- Ganti John Doe dengan ID User atau Order Number --}}
                        <h4>Order: {{ $order->order_number }}</h4>

                        {{-- Nanti bisa panggil relasi produk: $order->product->name --}}
                        <p>ID Produk: {{ $order->product_id }}</p>
                        <p>x {{ $order->quantity }} lembar</p>
                        <p class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>

                    <div class="right">
                        <p style="margin-bottom: 5px;">Input No Resi:</p>
                        <form action="{{ route('admin.order.resi', $order->id) }}" method="POST">
                            @csrf
                            <div style="display: flex; gap: 8px; margin-bottom: 10px;">
                                <input type="text" name="resi" id="resi-input-{{ $order->id }}" placeholder="Masukkan Resi JNE" required
                                    style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                <button type="button" onclick="startScanner('resi-input-{{ $order->id }}')"
                                    style="background-color: #3182ce; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; font-size: 13px;">
                                    📷 Scan
                                </button>
                            </div>

                            <button type="submit"
                                style="background-color: #b0435e; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; width: 100%; font-weight: bold;">
                                Kirim Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align: center;">Belum ada pesanan yang diproses.</p>
        @endif
        <div style="margin-top:1rem;">{{ $orders->links() }}</div>
    </div>

    {{-- Modal Scanner --}}
    <div id="scannerModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.8); z-index:9999; flex-direction:column; align-items:center; justify-content:center;">
        <div style="background:#fff; padding:15px; border-radius:8px; text-align:center; width:90%; max-width:500px;">
            <h3 style="margin-top:0;">Scan Barcode Resi</h3>
            <div id="interactive" class="viewport" style="width:100%; height:300px; overflow:hidden; position:relative;"></div>
            <button onclick="stopScanner()" style="margin-top:15px; background:#e53e3e; color:#fff; border:none; padding:10px 20px; border-radius:5px; cursor:pointer;">Tutup Scanner</button>
        </div>
    </div>

    <!-- Include QuaggaJS dari CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script>
        let _targetInputId = null;

        function startScanner(inputId) {
            _targetInputId = inputId;
            document.getElementById('scannerModal').style.display = 'flex';

            Quagga.init({
                inputStream : {
                    name : "Live",
                    type : "LiveStream",
                    target: document.querySelector('#interactive'),
                    constraints: {
                        facingMode: "environment" // Gunakan kamera belakang jika di HP
                    }
                },
                decoder : {
                    readers : ["code_128_reader", "ean_reader", "ean_8_reader", "code_39_reader"]
                }
            }, function(err) {
                if (err) {
                    console.log(err);
                    alert("Kamera tidak dapat diakses atau tidak ditemukan.");
                    return;
                }
                Quagga.start();
            });

            Quagga.onDetected(function(result) {
                let code = result.codeResult.code;
                if (_targetInputId) {
                    document.getElementById(_targetInputId).value = code;
                }
                stopScanner();
            });
        }

        function stopScanner() {
            Quagga.stop();
            document.getElementById('scannerModal').style.display = 'none';
            _targetInputId = null;
        }
    </script>
</body>

</html>
