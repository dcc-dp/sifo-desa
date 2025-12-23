@extends('layouts.user')

@section('title', 'Login | Sistem Informasi Desa')

@section('content')
<section class="auth-wrapper">
    <div class="card auth-container">
        <div class="logo" style="justify-content: center;">
            <i class="fas fa-leaf"></i> DESA DIGITAL
        </div>

        <h2>Login to Account</h2>

        
        @if(session('error'))
            <div style="color: red; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('userlogin.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" name="email" id="login-email"
                       placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" name="password" id="login-password"
                       placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">
                Login
            </button>

            <p style="margin-top: 20px; font-size: 0.9rem;">
                Don't have an account?
                <a href="{{ route('ceknik') }}">Check NIK</a>
            </p>

        </form>
    </div>
</section>
@endsection
