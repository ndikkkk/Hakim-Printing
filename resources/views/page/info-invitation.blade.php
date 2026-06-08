<!DOCTYPE html>
<html>

<head>
    <title>Information Page</title>

    <link rel="stylesheet" href="{{ asset('css/style-info-invitation.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>

    {{-- HEADER --}}
    <div class="navbar" style="position: relative;">
        <a href="{{ route('home') }}" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); text-decoration: none; color: #555; background: #fff; padding: 8px 15px; border-radius: 5px; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">← Kembali Beranda</a>
        <h2>Informasi Pesanan</h2>
    </div>

    {{-- BACKGROUND --}}
    <div class="bg">
        <div class="pink-top"></div>
        <div class="white-middle"></div>
        <div class="pink-bottom"></div>
    </div>

    {{-- CARD --}}
    <div class="card-container">
        <div class="card">

            <form action="{{ route('order.info.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Tambahkan input hidden untuk product_id --}}
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <h3>{{ $product->name }}</h3>
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                <p class="harga">Harga: Rp {{ number_format($product->price, 0, ',', '.') }} per lembar</p>

                <div class="form-group">
                    <label>Nama Lengkap Mempelai Pria</label>
                    <div class="input-box">
                        <input type="text" name="groom_name"
                            value="{{ old('groom_name', $invitationData['groom_name'] ?? '') }}" required>
                        @error('groom_name')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Ayah Mempelai Pria</label>
                    <div class="input-box">
                        <input type="text" name="groom_father"
                            value="{{ old('groom_father', $invitationData['groom_father'] ?? '') }}" required>
                        @error('groom_father')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Ibu Mempelai Pria</label>
                    <div class="input-box">
                        <input type="text" name="groom_mother"
                            value="{{ old('groom_mother', $invitationData['groom_mother'] ?? '') }}" required>
                        @error('groom_mother')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap Mempelai Wanita</label>
                    <div class="input-box">
                        <input type="text" name="bride_name"
                            value="{{ old('bride_name', $invitationData['bride_name'] ?? '') }}" required>
                        @error('bride_name')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Ayah Mempelai Wanita</label>
                    <div class="input-box">
                        <input type="text" name="bride_father"
                            value="{{ old('bride_father', $invitationData['bride_father'] ?? '') }}" required>
                        @error('bride_father')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Ibu Mempelai Wanita</label>
                    <div class="input-box">
                        <input type="text" name="bride_mother"
                            value="{{ old('bride_mother', $invitationData['bride_mother'] ?? '') }}" required>
                        @error('bride_mother')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Tanggal Acara (Akad)</label>
                    <div class="input-box">
                        <input type="date" name="akad_date"
                            value="{{ old('akad_date', $invitationData['akad_date'] ?? '') }}" required>
                        @error('akad_date')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Waktu Acara Akad (Contoh: 08.00 - Selesai)</label>
                    <div class="input-box">
                        <input type="text" name="akad_time"
                            value="{{ old('akad_time', $invitationData['akad_time'] ?? '') }}" required>
                        @error('akad_time')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Link Google Maps Lokasi</label>
                    <div class="input-box">
                        <input type="url" name="akad_location"
                            value="{{ old('akad_location', $invitationData['akad_location'] ?? '') }}"
                            placeholder="https://maps.app.goo.gl/..." required>
                        @error('akad_location')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Tanggal Acara (Resepsi)</label>
                    <div class="input-box">
                        <input type="date" name="event_date"
                            value="{{ old('event_date', $invitationData['event_date'] ?? '') }}" required>
                        @error('event_date')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Waktu Acara Resepsi (Contoh: 08.00 - Selesai)</label>
                    <div class="input-box">
                        <input type="text" name="event_time"
                            value="{{ old('event_time', $invitationData['event_time'] ?? '') }}" required>
                        @error('event_time')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Link Google Maps Lokasi</label>
                    <div class="input-box">
                        <input type="url" name="location_maps"
                            value="{{ old('location_maps', $invitationData['location_maps'] ?? '') }}"
                            placeholder="https://maps.app.goo.gl/..." required>
                        @error('location_maps')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Quotes (Opsional)</label>
                    <div class="input-box">
                        <input type="text" name="quotes"
                            value="{{ old('quotes', $invitationData['quotes'] ?? '') }}">
                        @error('quotes')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Upload File Foto/Desain Kustom (Opsional)</label>
                    <div class="input-box">
                        <input type="file" name="design_image" accept="image/*,.pdf" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%; box-sizing: border-box;">
                        @error('design_image')
                            <span class="error-msg" style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>
                    <small style="color: #666; font-size: 11px;">Format: JPG, PNG, PDF. Maks: 5MB.</small>
                </div>

                <div class="btn">
                    <button type="submit">Lanjut ke Data Pemesan</button>
                </div>

            </form>

        </div>
    </div>

</body>

</html>
