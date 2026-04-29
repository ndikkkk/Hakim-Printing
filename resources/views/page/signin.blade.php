<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style-signup.css') }}">
</head>
<body>

    <div class="container">
        <div class="left">
            <img src="{{ asset('images/img2.jpeg') }}">
        </div>

        <div class="right">
            <h2>Sign In</h2>

            <form action="{{ route('signin.process') }}" method="POST">
                @csrf

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

                <button type="submit">Sign In</button>

                <p class="login">
                    Belum memiliki akun? <a href="{{ route('signup') }}">Sign Up</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>
