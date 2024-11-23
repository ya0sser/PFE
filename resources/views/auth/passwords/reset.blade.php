<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Reset Password | Al-Jisr</title>
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

    <form class="login-box" action="{{ route('password.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="login-header">
            <h1>Reset Your Password</h1>
        </div>
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="input-box">
            <input type="email" class="input-field" id="email" name="email" placeholder="Email" required autofocus autocomplete="off" value="{{ old('email', $email) }}">
            @error('email')
            <span class="text-red-600" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-box">
             <input type="password" class="input-field" id="password" name="password" placeholder="New Password" required autocomplete="new-password">
             @error('password')
                 <span class="text-red-600" role="alert">{{ $message }}</span>
             @enderror
        </div>
        <div class="input-box">
        <input type="password" class="input-field" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password" required autocomplete="new-password">
        @error('password_confirmation')
              <span class="text-red-600" role="alert">{{ $message }}</span>
        @enderror
        </div>
        <div class="input-submit">
            <button type="submit" class="submit-btn" id="submit">Reset Password</button>
        </div>
         
    </form>
</section>
<footer>
    <br> <br> <br> <br>
</footer>
</body>
</html>
