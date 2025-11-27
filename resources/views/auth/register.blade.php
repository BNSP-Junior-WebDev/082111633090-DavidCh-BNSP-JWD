@extends('layouts.app')

@section('content')
<style>
    .auth-container { max-width: 400px; margin: 2rem auto; padding: 2rem; background: #fff; border: 1px solid #ddd; border-radius: 5px; }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; margin-bottom: 0.5rem; }
    .form-group input { width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box; }
    .auth-button { width: 100%; padding: 0.75rem; background-color: #4299e1; color: #fff; border: none; border-radius: 3px; cursor: pointer; font-size: 1rem; }
    .auth-button:hover { background-color: #2b6cb0; }
    .error-message { color: red; font-size: 0.9rem; margin-top: 0.25rem; }
</style>

<div class="auth-container">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="error-message">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="error-message">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @if ($errors->has('password'))
                <span class="error-message">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <button type="submit" class="auth-button">
                Register
            </button>
        </div>
        
        <p style="text-align: center;">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </p>
    </form>
</div>
@endsection
