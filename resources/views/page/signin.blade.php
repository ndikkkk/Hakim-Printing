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

        {{-- RIGHT FORM --}}
        <div class="right">
            <h2>Sign In</h2>

            <form action="{{ route('signin.process') }}" method="POST">
                @csrf
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
                </div>

                <div class="btn">
                    <button type="submit">Sign In</button>
                </div>

                <p class="login">
                    Belum memiliki akun? <a href="{{ route('signup') }}">Sign Up</a>
                </p>
            </form>
        </div>

    </div>

    <script>
        function handleSignup(e) {
            e.preventDefault();

            const email = document.querySelector('[name="email"]').value;

            alert("Login berhasil: " + email);

            window.location.href = "/signin";
        }
    </script>

</body>

</html>
