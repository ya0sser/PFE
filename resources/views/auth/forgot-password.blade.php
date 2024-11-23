<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/forgot-password.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Forgot Your Password | Al-Jisr</title>
</head>
<body>
<header>
@include('components.navbar')
</header>
    
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
<section>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="forgot-box">
            <div class="forgot-header">
                <h1>Forgot Your Password?</h1>
            </div>
            <div class="input-box">
                <input type="email" class="input-field" id="email" name="email" placeholder="Email" required autofocus autocomplete="off" value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-600" role="alert">{{ $message }}</span>
                @enderror
                <p>Please enter your email to receive a password reset link.</p>
            </div>
            <div class="input-submit">
                <button class="submit-btn" id="submit" type="submit"><label for="submit">Submit</label></button>
            </div>
        </div>
    </form>
</section>
</body>
</html>
