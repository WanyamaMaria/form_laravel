<h2>Login</h2>

<form method="POST" action="{{ route('login') }}">
    @csrf
    <input name="email" type="email" placeholder="Email"><br>
    <input name="password" type="password" placeholder="Password"><br>
    <button type="submit">Login</button>
</form>

<a href="{{ route('register')}}">Register</a>
