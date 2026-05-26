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

                <label>Password</label>
                <div class="input-group">
                    <img src="{{ asset('images/password.png') }}" class="icon">
                    <input type="password" name="password" id="password" required>
                    <span class="eye-icon" onclick="togglePassword('password', this)" title="Tampilkan password" style="cursor: pointer;">
                        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>
                </div>
                
                @if($errors->has('email') || $errors->has('password'))
                    <div style="background-color:#ffebee; color:#b0435e; padding:10px; border-radius:5px; margin-bottom:15px; font-size:14px; text-align:center; border:1px solid #ffcdd2;">
                        Email atau Password salah!
                    </div>
                @endif

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
                
                // Kembalikan ke password otomatis setelah 1 detik (1000ms)
                setTimeout(() => {
                    input.type = 'password';
                    icon.style.opacity = '0.6';
                }, 1000);
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
