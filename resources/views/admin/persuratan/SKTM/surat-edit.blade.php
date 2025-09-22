<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white">
                            <h4 class="mb-0">Edit Status Surat</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('surat.update', $id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="diterima" {{ $tes->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="tolak" {{ $tes->status == 'tolak' ? 'selected' : '' }}>Ditolak</option>
                                        <option value="proses" {{ $tes->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('surat.index') }}" class="btn btn-secondary me-2">Batal</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-app.footer />
    </main>
</x-app-layout>