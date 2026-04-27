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

        <form onsubmit="handleSignup(event)" novalidate>
    @csrf

<label>Nama Lengkap</label>
<div class="input-group">
    <img src="{{ asset('images/user-icon.png') }}" class="icon">
    <input type="text" name="name">
</div>

<label>Email</label>
<div class="input-group">
    <img src="{{ asset('images/email.png') }}" class="icon">
    <input type="email" name="email">
</div>

<label>Password</label>
<div class="input-group">
    <img src="{{ asset('images/password.png') }}" class="icon">
    <input type="password" name="password">
</div>

    <button type="submit">Sign Up</button>

    <p class="login">
        Sudah memiliki akun? <a href="/signin1">Sign In</a>
    </p>
</form>
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
