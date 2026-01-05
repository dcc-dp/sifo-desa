@extends('layouts.user')

@section('title', 'Cek NIK | Sistem Informasi Desa')

@section('content')
<section class="auth-wrapper">
    <div class="card auth-container">
        <div class="logo" style="justify-content: center;">
            <i class="fas fa-user-check"></i> CEK NIK
        </div>

        <h2>Cek NIK Anda</h2>
        <p style="font-size: 0.9rem; margin-bottom: 20px;">
            Masukkan NIK anda untuk melanjutkan proses registrasi akun.
        </p>

        @if (session('notfound'))
            <div style="color:red; margin-bottom: 15px;">
                {{ session('notfound') }}
            </div>
        @endif


        <form action="{{ route('ceknik.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nik_id">NIK</label>
                <input type="number" name="nik_id" id="nik_id" placeholder="Masukkan NIK anda" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:10px;">
                Cek NIK
            </button>
        </form>
    </div>
</section>
@endsection
