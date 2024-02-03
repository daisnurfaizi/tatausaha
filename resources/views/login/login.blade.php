<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/toastyfy.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ env('APP_URL') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="{{ asset('/js/jquery-3.7.1.js') }}"></script>
    <title>Login Page</title>
</head>

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input. <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif {{-- enderror --}}
    <div class="container">
        <div class="login">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h1>Login</h1>
                <p>SMP Bintang Timur</p>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="test@example.com"
                    placeholder="Enter your email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <label for="">Kode OTP</label>
                <input type="kode otp" placeholder="Kode OTP" required name="otp">
                {{-- minta otp --}}
                <p class="text-center"><a href="#" class="text-center" onclick="mintaOtp()">Minta OTP</a></p>
                <p id="countDown" class="text-center">
                </p>
                {{-- <p class="text-center"><a href="{{ route('password.request') }}">Forgot password?</a></p> --}}
                <button type="submit" class="a-button">Login</button>
                {{-- <p class="text-center">Not registered? <a href="{{ route('register') }}">Register</a></p> --}}
                <p class="text-center"><a href="{{ route('password.request') }}">Forgot password?</a></p>

                {{-- <p>
                    <a href="#">Forgot Password?</a>
                </p> --}}
            </form>
        </div>
        <div class="right">
            @if (!empty($aplication->login_logo))
                <img src="{{ URL::asset('storage/' . $aplication->login_logo) }} " alt="user-profile-image">
            @else
                <img src="" alt="user-profile-image">
            @endif
        </div>
    </div>
</body>
<script src="{{ asset('/js/toastify.js') }}"></script>
<script src="{{ asset('/js/script.js') }}"></script>

</html>
