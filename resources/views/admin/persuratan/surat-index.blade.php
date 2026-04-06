@extends('layouts.admin')

@section('title', 'Kelola Pengajuan Surat')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <h1><i class="fas fa-file-alt"></i> Kelola Pengajuan Surat</h1>
    </div>

    @if (session('success'))
        <div style="background-color: #d1e7dd; border: 1px solid #badbcc; color: #0f5132; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
            <h5 style="margin: 0;">Daftar Pengajuan Surat</h5>
            <input type="text" id="searchInput" placeholder="Cari NIK, Nama, atau Nomor Surat..." style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 5px; width: 300px;">
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">No Surat</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">NIK</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Nama Penduduk</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Keterangan</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Tgl Dibuat</th>
                        <th style="padding: 12px; text-align: center; border-bottom: 2px solid #ddd;">Status</th>
                        <th style="padding: 12px; text-align: center; border-bottom: 2px solid #ddd;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="suratTableBody">
                    @forelse ($data as $item)
                        <tr style="border-bottom: 1px solid #eee; hover-background: #f9f9f9;">
                            <td style="padding: 12px;">{{ $item->nomor_surat }}</td>
                            <td style="padding: 12px;">{{ $item->penduduk?->nik ?? '-' }}</td>
                            <td style="padding: 12px;">{{ $item->penduduk?->nama ?? '-' }}</td>
                            <td style="padding: 12px;">{{ $item->keterangan }}</td>
                            <td style="padding: 12px;">{{ \Carbon\Carbon::parse($item->tanggal_dibuat)->format('d/m/Y') }}</td>
                            <td style="padding: 12px; text-align: center;">
                                <span class="status-badge status-{{ strtolower($item->status) }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="{{ route('surat.edit', $item->id) }}" class="btn-sm" style="display: inline-block; padding: 6px 12px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 4px; font-size: 12px;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 20px; text-align: center; color: #999;">Tidak ada data pengajuan surat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($data->hasPages())
            <div style="padding: 20px; text-align: center;">
                {{ $data->links() }}
            </div>
        @endif
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
    .btn-sm {
        display: inline-block;
        padding: 8px 16px;
        background-color: #0d6efd;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 13px;
        transition: background-color 0.3s;
    }
    .btn-sm:hover {
        background-color: #0b5ed7;
    }
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }
    .status-menunggu {
        background-color: #fff3cd;
        color: #856404;
    }
    .status-proses {
        background-color: #cfe2ff;
        color: #084298;
    }
    .status-diterima {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    .status-tolak {
        background-color: #f8d7da;
        color: #842029;
    }
</style>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function(e) {
        let keyword = e.target.value.toLowerCase();
        let rows = document.querySelectorAll('#suratTableBody tr');
        
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>

@endsection
