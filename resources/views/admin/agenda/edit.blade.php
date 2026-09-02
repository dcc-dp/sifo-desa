<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('agenda-index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Agenda</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-edit"></i>
                        <span>Edit Agenda Kegiatan</span>
                    </h2>
                    <p class="admin-page-subtitle">Perbarui nama kegiatan atau jadwal waktu pelaksanaan</p>
                </div>
            </div>

            <!-- ALERT -->
            @if (session('error'))
                <div class="alert alert-danger mb-4" role="alert" id="alert">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success mb-4 text-white border-0" style="background: #15803d;" role="alert" id="alert">{{ session('success') }}</div>
            @endif

            <!-- FORM CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-calendar-check text-muted"></i>
                        <span>Formulir Perubahan Agenda</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('agenda-update', $agendas->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-4">
                            <div class="col-md-7">
                                <label for="nama_kegiatan" class="admin-form-label">Nama Kegiatan <span class="required">*</span></label>
                                <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                                    value="{{ old('nama_kegiatan', $agendas->nama_kegiatan) }}"
                                    class="form-control @error('nama_kegiatan') is-invalid @enderror" required>
                                @error('nama_kegiatan')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label for="waktu_pelaksanaan" class="admin-form-label">Waktu Kegiatan <span class="required">*</span></label>
                                <input type="datetime-local" name="waktu_pelaksanaan" id="waktu_pelaksanaan"
                                    value="{{ old('waktu_pelaksanaan', \Carbon\Carbon::parse($agendas->waktu_pelaksanaan)->format('Y-m-d\TH:i')) }}"
                                    class="form-control @error('waktu_pelaksanaan') is-invalid @enderror" required>
                                @error('waktu_pelaksanaan')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('agenda-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Perbarui Agenda
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>