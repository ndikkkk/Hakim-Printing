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

        <form onsubmit="handleSignup(event)" novalidate>
            @csrf

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

            <button type="submit">Sign In</button>

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
