<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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
                    <input type="password" name="password" id="password" required maxlength="100">
                    <img src="{{ asset('images/eye.png') }}" class="eye-icon" onclick="togglePassword('password', this)" title="Tampilkan password" onerror="this.style.display='none'">
                </div>
                <div class="pw-footer">
                    <span class="char-counter" id="char-counter">0/100</span>
                </div>
                <div class="pw-strength-box" id="pw-strength-box">
                    <p>Kekuatan Password:</p>
                    <ul>
                        <li id="req-length">Minimal 8 karakter</li>
                        <li id="req-number">Memiliki angka</li>
                        <li id="req-uppercase">Memiliki huruf besar</li>
                        <li id="req-special">Memiliki karakter spesial (!@#$%^&*)</li>
                    </ul>
                </div>
                @error('password')
                    <span style="color:#b0435e; font-size:12px;">{{ $message }}</span>
                @enderror

                <label>Konfirmasi Password</label>
                <div class="input-group" id="confirm-group">
                    <img src="{{ asset('images/password.png') }}" class="icon">
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                    <img src="{{ asset('images/eye.png') }}" class="eye-icon" onclick="togglePassword('password_confirmation', this)" title="Tampilkan password" onerror="this.style.display='none'">
                </div>
                <div class="error-msg" id="confirm-error">Password tidak cocok!</div>

                <button type="submit" id="submit-btn">Sign Up</button>

                <p class="login">
                    Sudah memiliki akun? <a href="{{ route('signin') }}">Sign In</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        // Toggle Show/Hide Password
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

        const pwInput = document.getElementById('password');
        const pwStrengthBox = document.getElementById('pw-strength-box');
        const charCounter = document.getElementById('char-counter');
        const reqLength = document.getElementById('req-length');
        const reqNumber = document.getElementById('req-number');
        const reqUppercase = document.getElementById('req-uppercase');
        const reqSpecial = document.getElementById('req-special');

        const confirmInput = document.getElementById('password_confirmation');
        const confirmGroup = document.getElementById('confirm-group');
        const confirmError = document.getElementById('confirm-error');

        const submitBtn = document.getElementById('submit-btn');

        // Regex validasi email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        function validateEmail() {
            if (emailInput.value.trim() === '') {
                emailGroup.classList.remove('error');
                emailError.style.display = 'none';
                return false;
            }
            if (!emailRegex.test(emailInput.value)) {
                emailGroup.classList.add('error');
                emailError.style.display = 'block';
                return false;
            } else {
                emailGroup.classList.remove('error');
                emailError.style.display = 'none';
                return true;
            }
        }

        function updatePwStrength() {
            const val = pwInput.value;
            charCounter.textContent = val.length + '/100';

            const hasLength = val.length >= 8;
            const hasNumber = /\d/.test(val);
            const hasUpper = /[A-Z]/.test(val);
            const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(val);

            reqLength.className = hasLength ? 'valid' : '';
            reqNumber.className = hasNumber ? 'valid' : '';
            reqUppercase.className = hasUpper ? 'valid' : '';
            reqSpecial.className = hasSpecial ? 'valid' : '';

            return hasLength && hasNumber && hasUpper && hasSpecial;
        }

        function validateConfirm() {
            if (confirmInput.value === '') {
                confirmGroup.classList.remove('error');
                confirmError.style.display = 'none';
                return false;
            }
            if (confirmInput.value !== pwInput.value) {
                confirmGroup.classList.add('error');
                confirmError.style.display = 'block';
                return false;
            } else {
                confirmGroup.classList.remove('error');
                confirmError.style.display = 'none';
                return true;
            }
        }

        function checkFormValidity() {
            // Karena tidak dipaksakan backend, kita hanya disable submit jika ada indikasi error jelas
            const isEmailValid = emailInput.value === '' || emailRegex.test(emailInput.value);
            const isConfirmValid = confirmInput.value === '' || confirmInput.value === pwInput.value;

            if (!isEmailValid || !isConfirmValid) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
            } else {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            }
        }

        emailInput.addEventListener('input', () => { validateEmail(); checkFormValidity(); });
        pwInput.addEventListener('focus', () => pwStrengthBox.style.display = 'block');
        pwInput.addEventListener('blur', () => pwStrengthBox.style.display = 'none');
        pwInput.addEventListener('input', () => { updatePwStrength(); validateConfirm(); checkFormValidity(); });
        confirmInput.addEventListener('input', () => { validateConfirm(); checkFormValidity(); });
    </script>
</body>
</html>
