<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="container">
    @if(session('success'))
        <div id="success-message" class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    <div class="form-box">
        <div class="logo">
            <i class="fas fa-user-lock"></i>
        </div>
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input name="email" type="email" placeholder="Email" required>
            </div>
            <div class="input-group" style="position:relative;">
                <i class="fas fa-lock"></i>
                <input name="password" type="password" id="password" placeholder="Password" required style="padding-right: 35px;">
                <span onclick="togglePassword()" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;">
                    <i id="eye-icon" class="fa fa-eye"></i>
                </span>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="link">
            Don’t have an account? <a href="{{ route('register') }}">Register</a>
        </div>
    </div>

    <script>
    function togglePassword() {
        var input = document.getElementById('password');
        var icon = document.getElementById('eye-icon');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    // Wait 4 seconds, then fade out the message
    setTimeout(() => {
        const flash = document.getElementById('success-message');
        if (flash) {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500); // Remove from DOM after fade
        }
    }, 4000); // 4 seconds
</script>

</body>


</html>
