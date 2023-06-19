<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<script src="{{ asset('js/login.js') }}"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    @if (Session::has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- @if ($errors->any())
        <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
            @endforeach

        </div>
    @endif --}}
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="{{ route('login.valid') }}">
            @csrf
            <div class="form-group">
                <label for="userid">Email:</label>
                <input type="text" id="userid" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
            </div>
            <button type="submit" class="btn">Login</button>
            <p>Belum punya akun? <a href="/register">Daftar disini</a></p>
        </form>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
