@extends('layouts.user')

@section('title', 'Login Pengaduan | Sistem Informasi Desa')

@section('content')

<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 150px);
        padding: 20px;
        background: linear-gradient(135deg, rgba(52, 152, 219, 0.05) 0%, rgba(52, 152, 219, 0.1) 100%);
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        padding: 0;
        border-radius: 20px;
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        background-color: white;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 40px rgba(0, 0, 0, 0.15);
    }

    .login-header {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
        padding: 30px 20px;
        text-align: center;
        color: white;
    }

    .login-header h2 {
        margin-bottom: 8px;
        font-size: 26px;
        font-weight: 600;
        color: white;
    }

    .login-header h2 i {
        margin-right: 10px;
    }

    .login-header p {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0;
        font-size: 14px;
    }

    .login-body {
        padding: 35px 40px 40px 40px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--color-text);
        font-size: 14px;
    }

    .form-group label i {
        margin-right: 8px;
        color: var(--color-primary);
        width: 18px;
    }

    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .form-group input {
        width: 100%;
        padding: 14px 15px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--color-primary);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
    }

    .form-group input:hover {
        border-color: #cbd5e0;
    }

    .form-group small {
        display: block;
        margin-top: 8px;
        color: #6c757d;
        font-size: 11px;
    }

    .form-group small i {
        margin-right: 5px;
        font-size: 10px;
    }

    .btn-login {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .btn-login i {
        margin-right: 8px;
    }

    .alert {
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideIn 0.3s ease;
    }

    .alert i {
        font-size: 18px;
    }

    .alert-danger {
        background-color: #fff5f5;
        color: #c33;
        border: 1px solid #fcd5d5;
    }

    .alert-success {
        background-color: #f0fff4;
        color: #2e7d32;
        border: 1px solid #c6f6d5;
    }

    .error-message {
        color: #e53e3e;
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .error-message i {
        font-size: 11px;
    }

    .back-link {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }

    .back-link a {
        color: var(--color-primary);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .back-link a:hover {
        gap: 12px;
        color: var(--color-primary-dark);
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animasi untuk form */
    .form-group {
        animation: fadeInUp 0.4s ease backwards;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 480px) {
        .login-body {
            padding: 25px 25px 30px 25px;
        }
        
        .login-header {
            padding: 25px 20px;
        }
        
        .login-header h2 {
            font-size: 22px;
        }
        
        .btn-login {
            padding: 12px;
        }
    }
</style>

<section>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>
                    <i class="fas fa-file-signature"></i> 
                    Login Pengaduan
                </h2>
                <p>Layanan pengaduan masyarakat online</p>
            </div>
            
            <div class="login-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                <form action="{{ route('pengaduan.login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nik">
                            <i class="fas fa-id-card"></i> 
                            NIK (Nomor Identitas Kependudukan)
                        </label>
                        <div class="input-group">
                            <input 
                                type="text" 
                                id="nik" 
                                name="nik" 
                                placeholder="Masukkan 16 digit NIK Anda"
                                inputmode="numeric"
                                pattern="\d*"
                                value="{{ old('nik') }}"
                                maxlength="16"
                                minlength="16"
                                title="NIK harus terdiri dari 16 digit angka"
                                required
                            >
                        </div>
                        <small>
                            <i class="fas fa-info-circle"></i> 
                            Masukkan 16 digit NIK tanpa spasi (contoh: 1234567890123456)
                        </small>
                        @error('nik')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> 
                        Login & Lanjutkan
                    </button>
                </form>

                <div class="back-link">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left"></i> 
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection