<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style-signup.css') }}">
</head>
<body>

    <div class="container">
        <div class="left">
            <img src="{{ asset('images/img2.jpeg') }}">
        </div>

        <div class="right">
            <h2>Sign Up</h2>

            <form action="{{ route('signup.process') }}" method="POST">
                @csrf

                <label>Nama Lengkap</label>
                <div class="input-group">
                    <img src="{{ asset('images/user-icon.png') }}" class="icon">
                    <input type="text" name="name" value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <span style="color:#b0435e; font-size:12px;">{{ $message }}</span>
                @enderror

                <label>Email</label>
                <div class="input-group">
                    <img src="{{ asset('images/email.png') }}" class="icon">
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <span style="color:#b0435e; font-size:12px;">{{ $message }}</span>
                @enderror

                <label>Password</label>
                <div class="input-group">
                    <img src="{{ asset('images/password.png') }}" class="icon">
                    <input type="password" name="password" required>
                </div>
                @error('password')
                    <span style="color:#b0435e; font-size:12px;">{{ $message }}</span>
                @enderror

                <label>Konfirmasi Password</label>
                <div class="input-group">
                    <img src="{{ asset('images/password.png') }}" class="icon">
                    <input type="password" name="password_confirmation" required>
                </div>

                <button type="submit">Sign Up</button>

                <p class="login">
                    Sudah memiliki akun? <a href="{{ route('signin') }}">Sign In</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>
