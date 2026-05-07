<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style-signup.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
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
                <div class="input-group" id="email-group">
                    <img src="{{ asset('images/email.png') }}" class="icon">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                </div>
                <div class="error-msg" id="email-error">Format email tidak valid.</div>
                @error('email')
                    <span style="color:#b0435e; font-size:12px;">{{ $message }}</span>
                @enderror

                <label>Password</label>
                <div class="input-group">
                    <img src="{{ asset('images/password.png') }}" class="icon">
                    <input type="password" name="password" id="password" required>
                    <img src="{{ asset('images/eye.png') }}" class="eye-icon" onclick="togglePassword('password', this)" title="Tampilkan password" onerror="this.style.display='none'">
                </div>
                @error('password')
                    <span style="color:#b0435e; font-size:12px;">{{ $message }}</span>
                @enderror

                <button type="submit" id="submit-btn">Sign In</button>

                <p class="login">
                    Belum memiliki akun? <a href="{{ route('signup') }}">Sign Up</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.style.opacity = '1';
            } else {
                input.type = 'password';
                icon.style.opacity = '0.6';
            }
        }

        const emailInput = document.getElementById('email');
        const emailGroup = document.getElementById('email-group');
        const emailError = document.getElementById('email-error');
        const submitBtn = document.getElementById('submit-btn');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        function validateEmail() {
            if (emailInput.value.trim() === '') {
                emailGroup.classList.remove('error');
                emailError.style.display = 'none';
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
                return;
            }
            if (!emailRegex.test(emailInput.value)) {
                emailGroup.classList.add('error');
                emailError.style.display = 'block';
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
            } else {
                emailGroup.classList.remove('error');
                emailError.style.display = 'none';
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            }
        }

        emailInput.addEventListener('input', validateEmail);
    </script>
</body>
</html>
