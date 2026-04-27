<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/style-signup.css') }}">
</head>

<body>

    <div class="container">

        {{-- LEFT IMAGE --}}
        <div class="left">
            <img src="{{ asset('images/img2.jpeg') }}">
        </div>

        {{-- RIGHT FORM --}}
        <div class="right">
            <h2>Sign Up</h2>

            <form action="{{ route('signup.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-box">
                        <input type="text" name="name" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-box">
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <span style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-box">
                        <input type="password" name="password" required>
                    </div>
                    @error('password')
                        <span style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-box">
                        <input type="password" name="password_confirmation" required>
                    </div>
                </div>

                <div class="btn">
                    <button type="submit">Sign Up</button>
                </div>

                <p class="login">
                    Sudah memiliki akun? <a href="{{ route('signin') }}">Sign In</a>
                </p>
            </form>

        </div>

        <script>
            function handleSignup(e) {
                e.preventDefault();

                const name = document.querySelector('[name="name"]').value;

                alert("Akun berhasil dibuat, silakan login " + name);

                window.location.href = "/signin1";
            }
        </script>

</body>

</html>
