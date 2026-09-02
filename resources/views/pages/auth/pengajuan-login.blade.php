@extends('layouts.user')

@section('title', 'Login Pengajuan Surat | Sistem Informasi Desa')

@section('content')

@php
    $setting = \App\Models\Setting::first();
    $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
@endphp

<style>
    .auth-page-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 200px);
        padding: 50px 20px;
        background: radial-gradient(circle at 50% 25%, rgba(21, 128, 61, 0.07) 0%, rgba(248, 250, 252, 0.95) 60%, #f1f5f9 100%);
    }

    .auth-card-modern {
        width: 100%;
        max-width: 440px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        box-shadow: 0 20px 45px -15px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.02);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .auth-card-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 26px 50px -12px rgba(0, 0, 0, 0.12);
    }

    .auth-card-header {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
        padding: 36px 28px 30px;
        text-align: center;
        color: #ffffff;
        position: relative;
    }

    .auth-badge-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.16);
        border: 1.5px solid rgba(255, 255, 255, 0.3);
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: #ffffff;
        margin-bottom: 16px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .auth-card-header h2 {
        font-size: 1.45rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0 0 6px;
        line-height: 1.3;
    }

    .auth-card-header p {
        font-size: 0.86rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        line-height: 1.5;
    }

    .auth-card-body {
        padding: 32px 30px 36px;
    }

    .auth-form-group {
        margin-bottom: 22px;
    }

    .auth-form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #334155;
        margin-bottom: 9px;
    }

    .auth-form-label i {
        color: var(--color-primary);
        font-size: 0.95rem;
    }

    .auth-input-wrapper {
        position: relative;
    }

    .auth-input-field {
        width: 100%;
        padding: 13px 16px;
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        background-color: #f8fafc;
        font-size: 1.05rem;
        font-weight: 600;
        color: #1e293b;
        letter-spacing: 1.5px;
        transition: all 0.2s ease;
    }

    .auth-input-field:focus {
        outline: none;
        border-color: var(--color-primary);
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.14);
    }

    .auth-helper-text {
        display: flex;
        align-items: flex-start;
        gap: 6px;
        font-size: 0.78rem;
        color: #64748b;
        margin-top: 8px;
        line-height: 1.4;
    }

    .auth-helper-text i {
        color: var(--color-primary);
        margin-top: 2px;
        flex-shrink: 0;
    }

    .auth-error-alert {
        padding: 12px 16px;
        border-radius: 12px;
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        font-size: 0.84rem;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 20px;
    }

    .auth-success-alert {
        padding: 12px 16px;
        border-radius: 12px;
        background-color: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
        font-size: 0.84rem;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 20px;
    }

    .auth-btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 13px 20px;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
        color: #ffffff;
        font-size: 0.95rem;
        font-weight: 700;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(21, 128, 61, 0.28);
        transition: all 0.25s ease;
        margin-top: 6px;
    }

    .auth-btn-submit:hover {
        background: linear-gradient(135deg, var(--color-primary-hover) 0%, #0f3d1b 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(21, 128, 61, 0.38);
    }

    .auth-back-link {
        text-align: center;
        margin-top: 24px;
        padding-top: 18px;
        border-top: 1px solid #f1f5f9;
    }

    .auth-back-link a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .auth-back-link a:hover {
        color: var(--color-primary);
        gap: 10px;
    }
</style>

<section>
    <div class="auth-page-wrapper">
        <div class="auth-card-modern">
            <div class="auth-card-header">
                <div class="auth-badge-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h2>Pengajuan Surat Online</h2>
                <p>Layanan mandiri permohonan surat administrasi warga Desa {{ $desaName }}</p>
            </div>
            
            <div class="auth-card-body">
                @if ($errors->any())
                    <div class="auth-error-alert">
                        <i class="fas fa-exclamation-circle fs-5 mt-1"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="auth-success-alert">
                        <i class="fas fa-check-circle fs-5 mt-1"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                <form action="{{ route('pengajuan.login') }}" method="POST">
                    @csrf

                    <div class="auth-form-group">
                        <label for="nik" class="auth-form-label">
                            <i class="fas fa-id-card"></i> 
                            <span>Nomor Induk Kependudukan (NIK)</span>
                        </label>
                        <div class="auth-input-wrapper">
                            <input 
                                type="text" 
                                id="nik" 
                                name="nik" 
                                class="auth-input-field"
                                placeholder="Masukkan 16 digit NIK"
                                inputmode="numeric"
                                pattern="\d*"
                                value="{{ old('nik') }}"
                                maxlength="16"
                                minlength="16"
                                title="NIK harus terdiri dari 16 digit angka"
                                required
                                autofocus
                            >
                        </div>
                        <div class="auth-helper-text">
                            <i class="fas fa-info-circle"></i> 
                            <span>Gunakan 16 digit NIK yang terdaftar pada Kartu Keluarga / KTP Anda.</span>
                        </div>
                    </div>

                    <button type="submit" class="auth-btn-submit">
                        <i class="fas fa-sign-in-alt"></i> 
                        <span>Masuk & Lanjutkan</span>
                    </button>
                </form>

                <div class="auth-back-link">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left"></i> 
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection