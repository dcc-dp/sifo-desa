<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">Detail Surat</h2>
                    <hr style="height:2px; color:black;">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body p-4">

                            <p><strong>Penduduk:</strong> {{ $surat->penduduk->nama }} (NIK: {{ $surat->penduduk->nik }})</p>
                            <p><strong>Jenis Surat:</strong> {{ $surat->jenisSurat->nama_jenis }}</p>
                            <p><strong>Nomor Surat:</strong> {{ $surat->nomor_surat }}</p>
                            <p><strong>Tanggal Dibuat:</strong> {{ $surat->tanggal_dibuat }}</p>
                            
                            <p><strong>Status:</strong> 
                                @if($surat->status == 'proses')
                                    <span class="badge bg-warning">Proses</span>
                                @elseif($surat->status == 'diterima')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif($surat->status == 'tolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </p>

                            <p><strong>Keterangan:</strong> {{ $surat->keterangan ?? '-' }}</p>

                            <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>