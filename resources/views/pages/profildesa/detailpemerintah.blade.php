@extends('layouts.user')

@section('title', 'Detail Pemerintah | Sistem Informasi Desa')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row align-items-start">

                <div class="col-lg-5 mb-4">
                    <h2 class="fw-bold text-primary mb-3">Profil Pemerintah Desa</h2>
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset($pemerintah->foto ?? '/upload/pemerintah/default.jpg') }}"
                            class="img-fluid rounded"
                            style="width:100%; height:420px; object-fit:contain; background:#f8f9fa;">
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm p-4 h-100">

                        <h1 class="fw-bold text-success mb-4">Biodata</h1>

                        <div class="mb-3">
                            <strong class="fw-semibold text-dark">Nama</strong>
                            <p class="fs-5 text-muted mb-2">
                                {{ $pemerintah->nama }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <strong class="fw-semibold text-dark">Jabatan</strong>
                            <p class="fs-6 text-success fw-semibold mb-2">
                                {{ $pemerintah->jabatan }}
                            </p>
                        </div>

                        <div class="mb-0">
                            <strong class="fw-semibold text-dark">Tupoksi</strong>
                            <p>{!! nl2br(e($pemerintah->tupoksi)) !!}</p>
                        </div>
                        <a href="{{ url('/pemerintah') }}" class="btn btn-success w-100">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection