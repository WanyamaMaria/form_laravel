<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container">
    @if(session('success'))
        <div id="success-message" class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    <div class="form-box">
        <div class="logo">
            <i class="fas fa-user-plus"></i>
        </div>
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input name="name" type="text" placeholder="Name" required>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input name="email" type="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input name="password" type="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input name="password_confirmation" type="password" placeholder="Confirm Password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="link">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

    <script>
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
