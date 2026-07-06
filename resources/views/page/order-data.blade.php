<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan - Hakim Printing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4c3b1f73a2.js" crossorigin="anonymous"></script>
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
        
        .container { flex: 1; padding: 40px 5%; display: flex; justify-content: center; align-items: center; }
        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 1);
            border-radius: 24px; padding: 40px; width: 100%; max-width: 500px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 8px; color: #555; }
        .input-box {
            position: relative;
            display: flex; align-items: center;
        }
        .input-box i {
            position: absolute; left: 15px; color: #b6895b; font-size: 1.1rem;
        }
        .input-box input, .input-box select {
            width: 100%; padding: 12px 15px 12px 45px;
            border: 1px solid rgba(182, 137, 91, 0.3);
            border-radius: 12px; background: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem; color: #333; transition: all 0.3s ease;
            outline: none; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        .input-box select { cursor: pointer; }
        .input-box input:focus, .input-box select:focus { border-color: #b6895b; box-shadow: 0 0 0 3px rgba(182, 137, 91, 0.1); }
        
        .btn-submit {
            width: 100%; padding: 15px; background: linear-gradient(135deg, #b6895b, #a37a51);
            color: #fff; border: none; border-radius: 12px; font-size: 1rem; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(182, 137, 91, 0.3);
            margin-top: 20px;
        }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(182, 137, 91, 0.4); }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <nav class="navbar">
        <a href="{{ route('order.info', ['product_id' => session('selected_product.id')]) }}" class="back-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <div class="nav-title">Data Pesanan</div>
        <div style="width: 80px;"></div>
    </nav>

    <div class="container">
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
                        <select name="province_id" id="province" required>
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
                        <i class="fa fa-building"></i>
                        <select name="city_id" id="city" required disabled>
                            <option value="">-- Pilih Kota --</option>
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
                        <i class="fa fa-shopping-cart"></i>
                        <input type="number" name="quantity" min="100" value="{{ old('quantity', $orderData['quantity'] ?? '100') }}" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Lanjut ke Checkout &rarr;
                </button>
            </form>
        </div>
    </div>

    <!-- Script AJAX RajaOngkir -->
    <script>
        document.getElementById('province').addEventListener('change', function() {
            let provinceId = this.value;
            let citySelect = document.getElementById('city');

            citySelect.innerHTML = '<option value="">Loading...</option>';
            citySelect.disabled = true;

            if (provinceId) {
                fetch(`/order/get-cities/${provinceId}`)
                    .then(response => response.json())
                    .then(response => {
                        citySelect.innerHTML = '<option value="">-- Pilih Kota --</option>';
                        
                        // Komerce API wraps the actual cities array in response.data
                        let cities = response.data;
                        
                        if (cities && Array.isArray(cities)) {
                            cities.forEach(city => {
                                let option = document.createElement('option');
                                option.value = city.id;
                                option.text = city.name;
                                citySelect.add(option);
                            });
                        }
                        citySelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        citySelect.innerHTML = '<option value="">Gagal load data</option>';
                    });
            } else {
                citySelect.innerHTML = '<option value="">-- Pilih Kota --</option>';
                citySelect.disabled = true;
            }
        });
    </script>
</body>
</html>
