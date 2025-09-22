<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">Ajukan Surat</h2>
                    <hr style="height:2px; color:black;">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body p-4">
                            <form action="{{ route('surat.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Penduduk</label>
                                    <select name="penduduk_id" class="form-control" required>
                                        <option value="">-- Pilih Penduduk --</option>
                                        @foreach($penduduks as $penduduk)
                                            <option value="{{ $penduduk->id }}">
                                                {{ $penduduk->nama }} (NIK: {{ $penduduk->nik }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="mb-3">
                                    <label class="form-label">Jenis Surat</label>
                                    <select name="jenis_surat_id" class="form-control" required>
                                        <option value="">-- Pilih Jenis Surat --</option>
                                        @foreach($jenisSurats as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="mb-3">
                                    <label class="form-label">Nomor Surat</label>
                                    <input type="text" name="nomor_surat" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Dibuat</label>
                                    <input type="date" name="tanggal_dibuat" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                                </div>

                                <input type="hidden" name="status" value="proses">

                                <button type="submit" class="btn btn-dark">Ajukan</button>
                                <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>