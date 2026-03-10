@extends('layouts.user')

@section('title', 'Login Pengajuan Surat | Sistem Informasi Desa')

@section('content')

<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 150px);
        padding: 20px;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    .login-card h2 {
        text-align: center;
        margin-bottom: 10px;
        color: var(--color-primary);
        font-size: 24px;
    }

    .login-card p {
        text-align: center;
        color: var(--color-text-light);
        margin-bottom: 30px;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--color-text);
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
    }

    .form-group small {
        display: block;
        margin-top: 5px;
        color: #666;
        font-size: 12px;
    }

    .btn-login {
        width: 100%;
        padding: 12px;
        background-color: var(--color-primary);
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-login:hover {
        background-color: var(--color-primary-dark);
    }

    .alert {
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-danger {
        background-color: #fee;
        color: #c33;
        border: 1px solid #fcc;
    }

    .alert-success {
        background-color: #efe;
        color: #3c3;
        border: 1px solid #cfc;
    }

    .error-message {
        color: #c33;
        font-size: 12px;
        margin-top: 5px;
    }

    .back-link {
        text-align: center;
        margin-top: 20px;
    }

    .back-link a {
        color: var(--color-primary);
        text-decoration: none;
        font-size: 14px;
    }

    .back-link a:hover {
        text-decoration: underline;
    }
</style>

<section>
    <div class="login-container">
        <div class="login-card">
            <h2><i class="fas fa-envelope-open-text"></i> Login Pengajuan Surat</h2>
            <p>Masukkan NIK Anda yang terdaftar</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('pengajuan.login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nik">NIK (Nomor Identitas Kependudukan)</label>
                    <input 
                        type="text" 
                        id="nik" 
                        name="nik" 
                        placeholder="Masukkan 16 digit NIK Anda"
                        inputmode="numeric"
                        value="{{ old('nik') }}"
                        maxlength="16"
                        required
                    >
                    <small>Masukkan 16 digit NIK tanpa spasi</small>
                    @error('nik')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <div class="back-link">
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
