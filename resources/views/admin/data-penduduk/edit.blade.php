<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('data.penduduk-index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Data Penduduk</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-user-edit"></i>
                        <span>Edit Data Penduduk</span>
                    </h2>
                    <p class="admin-page-subtitle">Perbarui informasi kependudukan warga: <strong>{{ $data->nama }}</strong></p>
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
                        <i class="fas fa-id-card text-muted"></i>
                        <span>Perubahan Biodata Warga</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('data.penduduk-update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="nik" class="admin-form-label">Nomor Induk Kependudukan (NIK) <span class="required">*</span></label>
                                <input type="text" name="nik" id="nik"
                                    value="{{ old('nik', $data->nik) }}" class="form-control font-monospace @error('nik') is-invalid @enderror"
                                    maxlength="16" required>
                                @error('nik')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="admin-form-label">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" name="nama" id="nama"
                                    value="{{ old('nama', $data->nama) }}" class="form-control @error('nama') is-invalid @enderror" required>
                                @error('nama')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="admin-form-label">Tempat Lahir <span class="required">*</span></label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir"
                                    value="{{ old('tempat_lahir', $data->tempat_lahir) }}" class="form-control @error('tempat_lahir') is-invalid @enderror" required>
                                @error('tempat_lahir')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="admin-form-label">Tanggal Lahir <span class="required">*</span></label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                                @error('tanggal_lahir')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="admin-form-label">Jenis Kelamin <span class="required">*</span></label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="agama" class="admin-form-label">Agama <span class="required">*</span></label>
                                <select name="agama" id="agama" class="form-select @error('agama') is-invalid @enderror" required>
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam" {{ old('agama', $data->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $data->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $data->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $data->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Budha" {{ old('agama', $data->agama) == 'Budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="Konghucu" {{ old('agama', $data->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('agama')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="admin-form-label">Alamat Lengkap / Dusun <span class="required">*</span></label>
                            <textarea name="alamat" id="alamat" rows="2" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $data->alamat) }}</textarea>
                            @error('alamat')
                                <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="rw_id" class="admin-form-label">Rukun Warga (RW) <span class="required">*</span></label>
                                <select name="rw_id" id="rw_id" class="form-select @error('rw_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih RW --</option>
                                    @foreach ($rws as $rw)
                                        <option value="{{ $rw->id }}" {{ old('rw_id', $data->rw_id) == $rw->id ? 'selected' : '' }}>
                                            RW {{ $rw->nomor_rw }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rw_id')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="rt_id" class="admin-form-label">Rukun Tetangga (RT) <span class="required">*</span></label>
                                <select name="rt_id" id="rt_id" class="form-select @error('rt_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih RT --</option>
                                    @foreach ($rts as $rt)
                                        <option value="{{ $rt->id }}" {{ old('rt_id', $data->rt_id) == $rt->id ? 'selected' : '' }}>
                                            RT {{ $rt->nomor_rt }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rt_id')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="keldesa" class="admin-form-label">Kelurahan / Desa <span class="required">*</span></label>
                                <input type="text" name="keldesa" id="keldesa"
                                    value="{{ old('keldesa', $data->keldesa) }}" class="form-control @error('keldesa') is-invalid @enderror" required>
                                @error('keldesa')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="kecamatan" class="admin-form-label">Kecamatan <span class="required">*</span></label>
                                <input type="text" name="kecamatan" id="kecamatan"
                                    value="{{ old('kecamatan', $data->kecamatan) }}" class="form-control @error('kecamatan') is-invalid @enderror" required>
                                @error('kecamatan')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="status_perkawinan" class="admin-form-label">Status Perkawinan <span class="required">*</span></label>
                                <input type="text" name="status_perkawinan" id="status_perkawinan"
                                    value="{{ old('status_perkawinan', $data->status_perkawinan) }}" class="form-control @error('status_perkawinan') is-invalid @enderror" required>
                                @error('status_perkawinan')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="pekerjaan" class="admin-form-label">Pekerjaan <span class="required">*</span></label>
                                <select name="pekerjaan" id="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" required>
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <option value="Petani" {{ old('pekerjaan', $data->pekerjaan) == 'Petani' ? 'selected' : '' }}>Petani</option>
                                    <option value="Buruh" {{ old('pekerjaan', $data->pekerjaan) == 'Buruh' ? 'selected' : '' }}>Buruh</option>
                                    <option value="Wiraswasta" {{ old('pekerjaan', $data->pekerjaan) == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                    <option value="PNS" {{ old('pekerjaan', $data->pekerjaan) == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="TNI/Polri" {{ old('pekerjaan', $data->pekerjaan) == 'TNI/Polri' ? 'selected' : '' }}>TNI/Polri</option>
                                    <option value="Pelajar/Mahasiswa" {{ old('pekerjaan', $data->pekerjaan) == 'Pelajar/Mahasiswa' ? 'selected' : '' }}>Pelajar/Mahasiswa</option>
                                    <option value="Tidak Bekerja" {{ old('pekerjaan', $data->pekerjaan) == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                </select>
                                @error('pekerjaan')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="kewarganegaraan" class="admin-form-label">Kewarganegaraan <span class="required">*</span></label>
                                <input type="text" name="kewarganegaraan" id="kewarganegaraan"
                                    value="{{ old('kewarganegaraan', $data->kewarganegaraan) }}" class="form-control @error('kewarganegaraan') is-invalid @enderror" required>
                                @error('kewarganegaraan')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="pendidikan" class="admin-form-label">Pendidikan Terakhir <span class="required">*</span></label>
                                <select name="pendidikan" id="pendidikan" class="form-select @error('pendidikan') is-invalid @enderror" required>
                                    <option value="">-- Pilih Pendidikan --</option>
                                    <option value="Tidak Sekolah" {{ old('pendidikan', $data->pendidikan) == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                    <option value="SD" {{ old('pendidikan', $data->pendidikan) == 'SD' ? 'selected' : '' }}>SD / Sederajat</option>
                                    <option value="SMP" {{ old('pendidikan', $data->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP / Sederajat</option>
                                    <option value="SMA" {{ old('pendidikan', $data->pendidikan) == 'SMA' ? 'selected' : '' }}>SMA / Sederajat</option>
                                    <option value="D3" {{ old('pendidikan', $data->pendidikan) == 'D3' ? 'selected' : '' }}>Diploma (D3)</option>
                                    <option value="S1" {{ old('pendidikan', $data->pendidikan) == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                </select>
                                @error('pendidikan')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('data.penduduk-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Perbarui Data Penduduk
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>
