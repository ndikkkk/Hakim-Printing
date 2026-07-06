<!DOCTYPE html>
<html>
<head>
    <title>Informasi Pesanan - Hakim Printing</title>
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
        }
        .product-preview { text-align: center; margin-bottom: 30px; }
        .product-preview img { width: 120px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 15px; }
        .product-preview h3 { font-size: 1.5rem; color: #b6895b; margin-bottom: 5px; }
        .product-preview p { font-size: 1rem; color: #666; font-weight: 500; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 8px; color: #555; }
        .input-box input {
            width: 100%; padding: 12px 15px;
            border: 1px solid rgba(182, 137, 91, 0.3);
            border-radius: 12px; background: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem; color: #333; transition: all 0.3s ease;
            outline: none; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }
        .input-box input:focus { border-color: #b6895b; box-shadow: 0 0 0 3px rgba(182, 137, 91, 0.1); }
        .error-msg { color: #dc3545; font-size: 0.8rem; margin-top: 5px; display: block; }
        
        .section-title {
            font-size: 1.1rem; color: #b6895b; font-weight: 600;
            margin: 30px 0 15px; padding-bottom: 10px; border-bottom: 2px dashed rgba(182, 137, 91, 0.3);
        }
        
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
        <a href="{{ route('home') }}" class="back-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <div class="nav-title">Informasi Pesanan</div>
        <div style="width: 80px;"></div> <!-- Spacer for centering -->
    </nav>

    <div class="container">
        <div class="card">
            <form action="{{ route('order.info.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="product-preview">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }} per lembar</p>
                </div>

                <div class="section-title">Data Mempelai Pria</div>
                <div class="form-group">
                    <label>Nama Lengkap Mempelai Pria</label>
                    <div class="input-box">
                        <input type="text" name="groom_name" value="{{ old('groom_name', $invitationData['groom_name'] ?? '') }}" required>
                        @error('groom_name') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Ayah Mempelai Pria</label>
                    <div class="input-box">
                        <input type="text" name="groom_father" value="{{ old('groom_father', $invitationData['groom_father'] ?? '') }}" required>
                        @error('groom_father') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Ibu Mempelai Pria</label>
                    <div class="input-box">
                        <input type="text" name="groom_mother" value="{{ old('groom_mother', $invitationData['groom_mother'] ?? '') }}" required>
                        @error('groom_mother') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="section-title">Data Mempelai Wanita</div>
                <div class="form-group">
                    <label>Nama Lengkap Mempelai Wanita</label>
                    <div class="input-box">
                        <input type="text" name="bride_name" value="{{ old('bride_name', $invitationData['bride_name'] ?? '') }}" required>
                        @error('bride_name') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Ayah Mempelai Wanita</label>
                    <div class="input-box">
                        <input type="text" name="bride_father" value="{{ old('bride_father', $invitationData['bride_father'] ?? '') }}" required>
                        @error('bride_father') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Ibu Mempelai Wanita</label>
                    <div class="input-box">
                        <input type="text" name="bride_mother" value="{{ old('bride_mother', $invitationData['bride_mother'] ?? '') }}" required>
                        @error('bride_mother') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="section-title">Detail Acara Akad</div>
                <div class="form-group">
                    <label>Tanggal Acara</label>
                    <div class="input-box">
                        <input type="date" name="akad_date" value="{{ old('akad_date', $invitationData['akad_date'] ?? '') }}" required>
                        @error('akad_date') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Waktu Acara (Contoh: 08.00 - Selesai)</label>
                    <div class="input-box">
                        <input type="text" name="akad_time" value="{{ old('akad_time', $invitationData['akad_time'] ?? '') }}" required>
                        @error('akad_time') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Link Google Maps Lokasi</label>
                    <div class="input-box">
                        <input type="url" name="akad_location" value="{{ old('akad_location', $invitationData['akad_location'] ?? '') }}" placeholder="https://maps.app.goo.gl/..." required>
                        @error('akad_location') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="section-title">Detail Acara Resepsi</div>
                <div class="form-group">
                    <label>Tanggal Acara</label>
                    <div class="input-box">
                        <input type="date" name="event_date" value="{{ old('event_date', $invitationData['event_date'] ?? '') }}" required>
                        @error('event_date') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Waktu Acara (Contoh: 08.00 - Selesai)</label>
                    <div class="input-box">
                        <input type="text" name="event_time" value="{{ old('event_time', $invitationData['event_time'] ?? '') }}" required>
                        @error('event_time') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Link Google Maps Lokasi</label>
                    <div class="input-box">
                        <input type="url" name="location_maps" value="{{ old('location_maps', $invitationData['location_maps'] ?? '') }}" placeholder="https://maps.app.goo.gl/..." required>
                        @error('location_maps') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="section-title">Tambahan (Opsional)</div>
                <div class="form-group">
                    <label>Quotes</label>
                    <div class="input-box">
                        <input type="text" name="quotes" value="{{ old('quotes', $invitationData['quotes'] ?? '') }}" placeholder="Tulis quote spesial Anda...">
                        @error('quotes') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Upload File Foto/Desain Kustom</label>
                    <div class="input-box">
                        <input type="file" name="design_image" accept="image/*,.pdf" style="background: transparent; border: 2px dashed rgba(182, 137, 91, 0.4); padding: 20px; cursor: pointer;">
                        @error('design_image') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <small style="color: #888; font-size: 11px; margin-top: 5px; display: block;">Format: JPG, PNG, PDF. Maks: 5MB.</small>
                </div>

                <button type="submit" class="btn-submit">
                    Lanjut ke Data Pemesan &rarr;
                </button>
            </form>
        </div>
    </div>
</body>
</html>
