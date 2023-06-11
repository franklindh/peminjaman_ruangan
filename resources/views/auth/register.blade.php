<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<script src="{{ asset('js/login.js') }}"></script>



<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- @if (Session::has('error'))
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
    @endif --}} -->





    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <h1>Register</h1>
        <form method="POST" action="{{ route('register.valid') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="name" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="userid">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Register</button>
            <p>Back to Login <a href="/login">click disini</a></p>
        </form>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
