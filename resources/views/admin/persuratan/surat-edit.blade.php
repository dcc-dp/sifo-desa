@extends('layouts.admin')

@section('title', 'Edit Status Surat')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <h1><i class="fas fa-edit"></i> Edit Status Pengajuan Surat</h1>
    </div>

    @if ($errors->any())
        <div style="background-color: #f8d7da; border: 1px solid #f5c2c7; color: #842029; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="max-width: 700px;">
        <div style="padding: 30px;">
            
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                <h5 style="margin-top: 0; margin-bottom: 15px;">Informasi Pengajuan</h5>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <p style="margin: 0; color: #666; font-size: 12px;">Nomor Surat</p>
                        <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 16px;">{{ $tes->nomor_surat }}</p>
                    </div>
                    <div>
                        <p style="margin: 0; color: #666; font-size: 12px;">Tanggal Dibuat</p>
                        <p style="margin: 5px 0 0 0; font-weight: bold;">{{ \Carbon\Carbon::parse($tes->tanggal_dibuat)->format('d/m/Y') }}</p>
                    </div>
                </div>

                <hr style="margin: 15px 0; border: none; border-top: 1px solid #ddd;">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <p style="margin: 0; color: #666; font-size: 12px;">NIK Penduduk</p>
                        <p style="margin: 5px 0 0 0; font-weight: bold;">{{ $tes->penduduk?->nik ?? '-' }}</p>
                    </div>
                    <div>
                        <p style="margin: 0; color: #666; font-size: 12px;">Nama Penduduk</p>
                        <p style="margin: 5px 0 0 0; font-weight: bold;">{{ $tes->penduduk?->nama ?? '-' }}</p>
                    </div>
                </div>

                <hr style="margin: 15px 0; border: none; border-top: 1px solid #ddd;">

                <div>
                    <p style="margin: 0; color: #666; font-size: 12px;">Keterangan Surat</p>
                    <p style="margin: 5px 0 0 0; font-weight: bold;">{{ $tes->keterangan }}</p>
                </div>
            </div>

            <form action="{{ route('surat.update', $id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 25px;">
                    <label for="status" style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">
                        <i class="fas fa-check-circle"></i> Status Pengajuan
                    </label>
                    <select id="status" name="status" style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 5px; font-size: 14px;" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="menunggu" {{ $tes->status === 'menunggu' ? 'selected' : '' }}>
                            ⏳ Menunggu Verifikasi
                        </option>
                        <option value="proses" {{ $tes->status === 'proses' ? 'selected' : '' }}>
                            🔄 Sedang Diproses
                        </option>
                        <option value="diterima" {{ $tes->status === 'diterima' ? 'selected' : '' }}>
                            ✅ Diterima/Disetujui
                        </option>
                        <option value="tolak" {{ $tes->status === 'tolak' ? 'selected' : '' }}>
                            ❌ Ditolak
                        </option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px; padding-top: 20px; border-top: 1px solid #eee;">
                    <button type="submit" style="flex: 1; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 14px;">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('surat.index') }}" style="flex: 1; padding: 12px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; text-align: center; font-weight: bold; cursor: pointer; font-size: 14px;">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .page-title {
        margin-bottom: 30px;
    }
    .page-title h1 {
        font-size: 28px;
        color: #333;
        margin: 0;
    }
    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    select:focus {
        outline: none;
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
    }
</style>

@endsection
